https://api.binderbyte.com/v1/track?api_key=8e49f28e0f2f2cf56393c352613eec358e85fb7077ce6f7f453ebb826a7b1f6d&courier=jne&awb=8825112045716759
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller
{
  private $api_key = '80ba6ce7b77c47520403f79dfcd389dd492c80cb338769373dad656cf32e91aa';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_admin');
  }
  public function cekresi()
  {
    $courier = $this->input->post('courier');
    $awb = $this->input->post('awb');
  }
}
