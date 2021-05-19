<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_home');
    $this->load->model('m_transaksi');
  }


  public function index()
  {
    if (empty($this->cart->contents())) {
      redirect('home');
    }
    $data = array(
      'title' => 'Keranjang Barang',
      'isi' => 'v_belanja'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  public function add()
  {
    $redirect_page = $this->input->post('redirect_page');
    $data = array(
      'id'      => $this->input->post('id'),
      'qty'     => $this->input->post('qty'),
      'price'   => $this->input->post('price'),
      'name'    => $this->input->post('name'),
    );
    $this->cart->insert($data);
    redirect($redirect_page, 'refresh');
  }
  public function delete($rowid)
  {
    $this->cart->remove($rowid);
    redirect('belanja');
  }
  public function update()
  {
    $i = 1;
    foreach ($this->cart->contents() as $items) {
      $data = array(
        'rowid' => $items['rowid'],
        'qty'   => $this->input->post($i . '[qty]'),
      );
      $this->cart->update($data);
      $i++;
    }

    redirect('belanja');
  }
  public function clear()
  {
    $this->cart->destroy();
    redirect('home');
  }
  public function checkout()
  {
    $this->login_pelanggan->proteksiHalaman();
    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' => '%s Harus dipilih'));
    $this->form_validation->set_rules('distrik', 'Distrik', 'required', array('required' => '%s Harus dipilih'));
    $this->form_validation->set_rules('paket', 'Paket', 'required', array('required' => '%s Harus dipilih'));
    $this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required', array('required' => '%s Harus dipilih'));
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Checkout Barang',
        'isi' => 'v_checkout'
      );
      $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
    } else {
      $data = array(
        'no_order' => $this->input->post('no_order'),
        'nama_penerima' => $this->input->post('nama_penerima'),
        'alamat' => $this->input->post('alamat'),
        'tipe' => $this->input->post('tipe'),
        'distrik' => $this->input->post('distrik'),
        'kode_pos' => $this->input->post('kodepos'),
        'provinsi' => $this->input->post('provinsi'),
        'no_hp_penerima' => $this->input->post('no_hp_penerima'),
        'ekspedisi' => $this->input->post('ekspedisi'),
        'berat' => $this->input->post('berat'),
        'paket' => $this->input->post('paket'),
        'ongkir' => $this->input->post('ongkir'),
        'estimasi' => $this->input->post('estimasi'),
      );
      $this->m_transaksi->simpan_pengiriman($data);
      $i = 1;
      foreach ($this->cart->contents() as $item) {
        $data_detail = array(
          'no_order' => $this->input->post('no_order'),
          'barang_id' => $item['id'],
          'qty' => $this->input->post('qty' . $i),
          'harga' => $this->input->post('price' . $i),
          'subtotal' => $this->input->post('subtotal' . $i),
        );
        $i++;
        $this->m_transaksi->simpan_detail($data_detail);
      }
      $data_pesanan = array(
        'no_order' => $this->input->post('no_order'),
        'id_pelanggan' => $this->session->userdata('id_pelanggan'),
        'total_bayar' => $this->input->post('total_bayar'),
        'tanggal_pesan' => date('Y-m-d'),
        'resi' => null,
        'status' => '0',
      );
      $this->m_transaksi->simpan_pesanan($data_pesanan);
      $this->session->set_flashdata('sukses', 'Pesanan sedang diproses');
      $this->cart->destroy();
      redirect('pesanan_saya');
    }
  }
}
