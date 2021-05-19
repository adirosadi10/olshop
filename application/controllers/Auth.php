<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function login_user()
  {
    $this->form_validation->set_rules('username', 'username', 'required', array('required' => '%s Harus diisi!!!'));
    $this->form_validation->set_rules('password', 'password', 'required', array('required' => '%s Harus diisi!!!'));

    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $this->login_user->login($username, $password);
    } else {

      $data = array(
        'title' => 'Login User'
      );
      $this->load->view('v_login_user', $data, FALSE);
    }
  }
  public function logout_user()
  {
    $this->login_user->logout();
  }
}
  
  /* End of file Auth.php */
