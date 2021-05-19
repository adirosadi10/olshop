<?php


defined('BASEPATH') or exit('No direct script access allowed');

class bank extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_bank');
  }

  // List all your items
  public function index($offset = 0)
  {

    $data = array(
      'title' => 'bank ',
      'bank' => $this->m_bank->get_all_data(),
      'isi' => 'v_bank'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $data = array(
      'akun_bank' => $this->input->post('akun_bank'),
      'no_rekening' => $this->input->post('no_rekening'),
      'atas_nama' => $this->input->post('atas_nama'),
    );
    $this->m_bank->add($data);
    $this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
    redirect('bank');
  }

  //Update one item
  public function edit($id_bank = NULL)
  {
    $data = array(
      'id_bank' => $id_bank,
      'akun_bank' => $this->input->post('akun_bank'),
      'no_rekening' => $this->input->post('no_rekening'),
      'atas_nama' => $this->input->post('atas_nama'),
    );
    $this->m_bank->edit($data);
    $this->session->set_flashdata('sukses', 'Data berhasil diedit');
    redirect('bank');
  }

  //Delete one item
  public function delete($id_bank = NULL)
  {
    $data = array(
      'id_bank' => $id_bank,
    );
    $this->m_bank->delete($data);
    $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
    redirect('bank');
  }
}
  
  /* End of file User.php */
