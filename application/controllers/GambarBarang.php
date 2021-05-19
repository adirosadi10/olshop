<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GambarBarang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_gambarBarang');
    $this->load->model('m_barang');
  }

  public function index()
  {
    $data = array(
      'title' => 'Gambar Barang',
      'gambarBarang' => $this->m_gambarBarang->get_all_data(),
      'isi' => 'gambarBarang/v_index'
    );
     
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function add($id_barang)
  {
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus diisi'));
    


    if ($this->form_validation->run() == TRUE) {
      $config['upload_path'] = './assets/gambarBarang/';
      $config['allowed_types'] = 'jpeg|jpg|png';
      $config['max_size']     = '2000';
      $this->upload->initialize($config);
      $field_name = "gambar";
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title' => 'Tambah Gambar',
          'barang' => $this->m_barang->get_all_data(),
          'error_upload' => $this->upload->display_errors(),
          'isi' => 'gambarBarang/v_add'
        );
        $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/gambarBarang/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $data = array(
          'id_barang' => $id_barang,
          'keterangan' => $this->input->post('keterangan'),
          'gambar' => $upload_data['uploads']['file_name'],
        );
        $this->m_gambarBarang->add($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dtambahkan');
        redirect('gambarBarang/add/'.$id_barang);
      }
    }


    $data = array(
      'title' => 'Tambah Gambar',
      'barang' => $this->m_barang->get_data($id_barang),
      'gambar' => $this->m_gambarBarang->get_gambar($id_barang),
      'isi' => 'gambarBarang/v_add'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }
  public function delete($id_barang, $id_gambar)
  {
    $gambar =  $this->m_gambarBarang->get_data($id_gambar);
    if ($gambar->gambar != "") {
      unlink('./assets/gambarBarang/' . $gambar->gambar);
    }
    $data = array(
      'id_gambar' => $id_gambar,
    );
    $this->m_gambarBarang->delete($data);
    $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
    redirect('gambarBarang/add/'.$id_barang);
  }
  // public function edit($id_barang, $id_gambar)
  // {
  //   $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus diisi'));

  //   if ($this->form_validation->run() == TRUE) {
  //     $config['upload_path'] = './assets/gambarBarang/';
  //     $config['allowed_types'] = 'jpeg|jpg|png';
  //     $config['max_size']     = '2000';
  //     $this->upload->initialize($config);
  //     $field_name = "gambar";
  //     if (!$this->upload->do_upload($field_name)) {
  //       $data = array(
  //         'title' => 'Edit Gambar',
  //         'barang' => $this->m_barang->get_all_data(),
  //         'gambar' => $this->m_gambarBarang->get_data($id_barang),
  //         'error_upload' => $this->upload->display_errors(),
  //         'isi' => 'gambarBarang/v_add'
  //       );
  //       $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  //     } else {
  //       $upload_data = array('uploads' => $this->upload->data());
  //       $config['image_library'] = 'gd2';
  //       $config['source_image'] = './assets/gambarBarang/' . $upload_data['uploads']['file_name'];
  //       $this->load->library('image_lib', $config);
  //       $data = array(
  //         'id_barang' => $id_barang,
  //         'id_gambar' => $id_gambar,
  //         'keterangan' => $this->input->post('keterangan'),
  //         'gambar' => $upload_data['uploads']['file_name'],
  //       );
  //       $this->m_gambarBarang->edit($data);
  //       $this->session->set_flashdata('sukses', 'Data berhasil diganti');
  //       redirect('gambarBarang/add/'.$id_barang);
  //     }
  //   }

  //   $data = array(
  //     'title' => 'edit Gambar',
  //     $this->m_barang->get_all_data(),
  //     'gambar' => $this->m_gambarBarang->get_gambar($id_barang),
  //     'isi' => 'gambarBarang/v_add'
  //   );
  //   $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  // }
}

/* End of file Admin.php */
