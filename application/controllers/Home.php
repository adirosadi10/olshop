<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_home');
  }


  public function index()
  {
    $data = array(
      'title' => 'Home',
      'barang' => $this->m_home->get_all_data(),
      'kategori' => $this->m_home->get_all_kategori(),
      'isi' => 'v_home'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  public function kategori($id_kategori)
  {
    $kategori = $this->m_home->get_kategori($id_kategori);
    $data = array(
      'title' => 'Kategori ' . $kategori->nama_kategori,
      'barangkategori' => $this->m_home->get_all_barang($id_kategori),
      'isi' => 'v_barang_kategori'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  public function detail_barang($id_barang)
  {
    $data = array(
      'title' => 'Detail barang',
      'detail_barang' => $this->m_home->detail_barang($id_barang),
      'detail_gambar' => $this->m_home->detail_gambar($id_barang),
      'isi' => 'v_detail_barang'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
}
// <?= base_url('home/kategori/' . $value->id_kategori) 

/* End of file Home.php */