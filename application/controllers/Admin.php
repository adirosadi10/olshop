<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_admin');
    $this->load->model('m_pesanan_masuk');
  }

  public function index()
  {

    $data = array(
      'title' => 'Dashboard',
      'grafik' => $this->m_admin->chart()->result(),
      'hari_ini' => $this->m_admin->hari_ini(),
      'total_barang' => $this->m_admin->total_barang(),
      'pesanan_baru' => $this->m_admin->pesanan_baru(),
      'total_kategori' => $this->m_admin->total_kategori(),
      'isi' => 'v_admin'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function setting()
  {
    $this->form_validation->set_rules('nama_distrik', 'Nama Distrik', 'required', array('required' => '%s Harus diisi!!!'));

    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Setting Toko',
        'dataset' => $this->m_admin->data_setting(),
        'isi' => 'v_setting'
      );
      $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
    } else {
      $data = array(
        'id' => 1,
        'lokasi' => $this->input->post('nama_distrik'),
        'nama_toko' => $this->input->post('nama_toko'),
        'alamat' => $this->input->post('alamat'),
        'no_telp' => $this->input->post('no_telp'),
        'email' => $this->input->post('email'),
      );
      $this->m_admin->edit($data);
      $this->session->set_flashdata('pesan', 'Data berhasil diupdate !!');
      redirect('admin/setting');
    }
  }
  public function pesanan()
  {
    $data = array(
      'title' => 'Pesanan Masuk',
      'belum_bayar' => $this->m_pesanan_masuk->belum_bayar(),
      'verifikasi' => $this->m_pesanan_masuk->verifikasi(),
      'diproses' => $this->m_pesanan_masuk->diproses(),
      'dikirim' => $this->m_pesanan_masuk->dikirim(),
      'selesai' => $this->m_pesanan_masuk->selesai(),
      'semua_pesanan' => $this->m_pesanan_masuk->semua_pesanan(),
      'detail_bayar' => $this->m_pesanan_masuk->detail_bayar(),
      'isi' => 'v_pesanan_masuk'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function proses($pesanan_id)
  {
    $update = array(
      'pesanan_id' => $pesanan_id,
      'status' => 2,
    );
    $this->m_pesanan_masuk->update_status($update);
    $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
    redirect('admin/pesanan');
  }
  public function kirim($pesanan_id)
  {
    $this->form_validation->set_rules('no_order', 'akun_bank', 'required', array('required' => '%s Harus diisi'));

    $update = array(
      'pesanan_id' => $pesanan_id,
      'resi' => $this->input->post('resi'),
      'status' => 3,
    );
    $this->m_pesanan_masuk->update_status($update);
    $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
    redirect('admin/pesanan');
  }
  public function selesai($pesanan_id)
  {
    $update = array(
      'pesanan_id' => $pesanan_id,
      'status' => 4,
    );
    $this->m_pesanan_masuk->update_status($update);
    $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
    redirect('admin/pesanan');
  }
}

/* End of file Admin.php */
