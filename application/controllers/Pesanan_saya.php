<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_transaksi');
    $this->load->model('m_admin');
    $this->load->model('m_pesanan_masuk');
  }

  public function index()
  {
    $data = array(
      'title' => 'Pesanan Saya',
      'belum_bayar' => $this->m_transaksi->belum_bayar(),
      'semua_pesanan' => $this->m_transaksi->semua_pesanan(),
      'verifikasi' => $this->m_transaksi->verifikasi(),
      'proses' => $this->m_transaksi->proses(),
      'kirim' => $this->m_transaksi->kirim(),
      'selesai' => $this->m_transaksi->selesai(),
      'detail' => $this->m_transaksi->detail(),
      'detail_bayar' => $this->m_pesanan_masuk->detail_bayar(),
      'data_bank' => $this->m_admin->data_bank(),
      'isi' => 'v_pesanan_saya'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  public function bayar($pesanan_id,)
  {

    $this->form_validation->set_rules('no_order', 'akun_bank', 'required', array('required' => '%s Harus diisi'));


    if ($this->form_validation->run() == TRUE) {
      $config['upload_path'] = './assets/bukti_transfer/';
      $config['allowed_types'] = 'jpeg|jpg|png';
      $config['max_size']     = '2000';
      $this->upload->initialize($config);
      $field_name = "bukti_transfer";
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title' => 'Pembayaran',
          'konfirmasi' => $this->m_transaksi->konfirmasi($pesanan_id),
          'ubah_jumlah' => $this->m_transaksi->ubah_jumlah($pesanan_id),

          'data_bank' => $this->m_admin->data_bank(),
          'isi' => 'v_pembayaran'
        );
        $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/bukti_transfer/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $simpan_konfirmasi = array(
          'no_order' => $this->input->post('no_order'),
          'bank' => $this->input->post('akun_bank'),
          'no_rekening' => $this->input->post('no_rekening'),
          'atas_nama' => $this->input->post('atas_nama'),
          'bukti_transfer' => $upload_data['uploads']['file_name'],
          'catatan' => $this->input->post('catatan'),
        );
        $this->m_transaksi->simpan_konfirmasi($simpan_konfirmasi);
        $update_jml = array(
          'id_barang' => $this->input->post('id_barang'),
          'jumlah' => $this->input->post('sisa'),
        );
        $this->m_transaksi->update_jumlah($update_jml);
        $update = array(
          'pesanan_id' => $pesanan_id,
          'status' => 1,
        );
        $this->m_transaksi->update_status($update);
        $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
        redirect('pesanan_saya');
      }
    }
    $data = array(
      'title' => 'Pembayaran',
      'konfirmasi' => $this->m_transaksi->konfirmasi($pesanan_id),
      'ubah_jumlah' => $this->m_transaksi->ubah_jumlah($pesanan_id),
      'data_bank' => $this->m_admin->data_bank(),
      'isi' => 'v_pembayaran'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  public function selesai($pesanan_id)
  {
    $update = array(
      'pesanan_id' => $pesanan_id,
      'status' => 4,
    );
    $this->m_pesanan_masuk->update_status($update);
    $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
    redirect('pesanan_saya');
  }
}
