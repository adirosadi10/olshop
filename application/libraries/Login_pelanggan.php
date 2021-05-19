<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_pelanggan
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
    $this->ci->load->model('m_auth');
  }
  public function login($email, $password)
  {
    $cek = $this->ci->m_auth->login_pelanggan($email, $password);
    if ($cek) {
      $id_pelanggan = $cek->id_pelanggan;
      $nama_pelanggan = $cek->nama_pelanggan;
      $email = $cek->email;
      // session
      $this->ci->session->set_userdata('email', $email);
      $this->ci->session->set_userdata('id_pelanggan', $id_pelanggan);
      $this->ci->session->set_userdata('nama_pelanggan', $nama_pelanggan);
      redirect('home');
    }
    $this->ci->session->set_flashdata('error', 'Email atau Password salah');
    redirect('pelanggan/login');
  }
  public function proteksiHalaman()
  {
    if ($this->ci->session->userdata('nama_pelanggan') == '') {
      $this->ci->session->set_flashdata('error', 'Silahkan login terlebih dahulu!!');
      redirect('pelanggan/login');
    }
  }
  public function logout()
  {
    $this->ci->session->unset_userdata('id_pelanggan');
    $this->ci->session->unset_userdata('email');
    $this->ci->session->unset_userdata('nama_pelanggan');
    $this->ci->session->set_flashdata('pesan', 'Anda telah Logout');
    redirect('pelanggan/login');
  }
}

/* End of file login_user.php */
