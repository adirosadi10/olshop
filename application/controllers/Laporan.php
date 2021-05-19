<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_laporan');
  }

  public function index()
  {
    $data = array(
      'title' => 'Laporan',
      'isi' => 'v_laporan'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function lap_harian()
  {
    $tanggal = $this->input->post('date');

    $data = array(
      'title' => 'Laporan Harian',
      'harian' => $this->m_laporan->harian($tanggal),
      'tanggal' => $tanggal,
      'isi' => 'v_laporan_harian'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function lap_bulanan()
  {
    $bulan = $this->input->post('bulan');
    $tgl = substr($bulan, 5, 2);
    $data = array(
      'title' => 'Laporan Bulanan',
      'bulanan' => $this->m_laporan->bulanan($tgl),
      'bulan' => $bulan,
      'isi' => 'v_laporan_bulanan'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function lap_tahunan()
  {
    $tahun = $this->input->post('tahun');
    $data = array(
      'title' => 'Laporan Tahunan',
      'tahunan' => $this->m_laporan->tahunan($tahun),

      'tahun' => $tahun,
      'isi' => 'v_laporan_tahunan'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
}
