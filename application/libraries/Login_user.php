<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_user
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
    $this->ci->load->model('m_auth');
  }
  public function login($username, $password)
  {
    $cek = $this->ci->m_auth->login_user($username, $password);
    if ($cek) {
      $nama_user = $cek->nama_user;
      $username = $cek->username;
      $level_user = $cek->level_user;
      // session
      $this->ci->session->set_userdata('username', $username);
      $this->ci->session->set_userdata('nama_user', $nama_user);
      $this->ci->session->set_userdata('level_user', $level_user);
      redirect('admin');
    }
    $this->session->set_flashdata('salah', 'Username atau Password salah');
    redirect('auth/login_user');
  }
  public function proteksiHalaman()
  {
    if ($this->ci->session->userdata('username') == '') {
      $this->ci->session->set_flashdata('pesan', 'Silahkan login terlebih dahulu!!');
      redirect('auth/login_user');
    }
  }
  public function logout()
  {
    $this->ci->session->unset_userdata('username');
    $this->ci->session->unset_userdata('nama_user');
    $this->ci->session->unset_userdata('level_user');
    $this->ci->session->set_flashdata('pesan', 'Anda telah Logout');
    redirect('auth/login_user');
  }
}

/* End of file login_user.php */
