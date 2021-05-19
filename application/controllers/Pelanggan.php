<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_pelanggan');
    $this->load->model('m_auth');
  }

  // Add a new item
  public function register()
  {

    $this->form_validation->set_rules(
      'nama_pelanggan',
      'Nama Pelanggan',
      'required',
    );
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('repassword', 'Re-password', 'required|matches[password]', array(
      'matches'     => '%s password tidak sama.'
    ));
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_pelanggan.email]', array(
      'is_unique'     => '%s email sudah terdaftar.'
    ));

    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Register',
        'isi' => 'v_register'
      );
      $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
    } else {
      $data = array(
        'nama_pelanggan' => $this->input->post('nama_pelanggan'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
      );
      $this->m_pelanggan->register($data);
      $this->session->set_flashdata('pesan', 'register sukses');
      redirect('pelanggan/login');
    }
  }
  public function login()
  {
    $this->form_validation->set_rules('email', 'email', 'required', array('required' => '%s Harus diisi!!!'));
    $this->form_validation->set_rules('password', 'password', 'required', array('required' => '%s Harus diisi!!!'));

    if ($this->form_validation->run() == TRUE) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $this->login_pelanggan->login($email, $password);
    } else {

      $data = array(
        'title' => 'Login',
        'isi' => 'v_login'
      );
      $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
    }
  }
  public function logout()
  {
    $this->login_pelanggan->logout();
  }
  public function akun()
  {
    $this->login_pelanggan->proteksiHalaman();
    $data = array(
      'title' => 'Akun',
      'isi' => 'v_akun'
    );
    $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  }
  // public function setting(){
  //   $data = array(
  //     'title' => 'Setting',
  //     'isi' => 'v_pelanggan_setting'
  //   );
  //   $this->load->view('layouts/v_wrapper_frontend', $data, FALSE);
  // }
}
