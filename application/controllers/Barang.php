<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_barang');
    $this->load->model('m_kategori');
  }

  // List all your items
  public function index($offset = 0)
  {

    $data = array(
      'title' => 'barang',
      'barang' => $this->m_barang->get_all_data(),
      'isi' => 'barang/v_barang'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', array('required' => '%s Harus diisi'));


    if ($this->form_validation->run() == TRUE) {
      $config['upload_path'] = './assets/gambar/';
      $config['allowed_types'] = 'jpeg|jpg|png';
      $config['max_size']     = '2000';
      $this->upload->initialize($config);
      $field_name = "gambar";
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title' => 'Tambah Barang',
          'kategori' => $this->m_kategori->get_all_data(),
          'error_upload' => $this->upload->display_errors(),
          'isi' => 'barang/v_add'
        );
        $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $data = array(
          'nama_barang' => $this->input->post('nama_barang'),
          'id_kategori' => $this->input->post('id_kategori'),
          'keterangan' => $this->input->post('keterangan'),
          'gambar' => $upload_data['uploads']['file_name'],
          'berat' => $this->input->post('berat'),
          'harga' => $this->input->post('harga'),
          'jumlah' => $this->input->post('jumlah'),
          'status' => $this->input->post('status'),
        );
        $this->m_barang->add($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dtambahkan');
        redirect('barang');
      }
    }


    $data = array(
      'title' => 'Tambah Barang',
      'kategori' => $this->m_kategori->get_all_data(),
      'isi' => 'barang/v_add'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_barang = NULL)
  {
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus diisi'));
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', array('required' => '%s Harus diisi'));


    if ($this->form_validation->run() == TRUE) {
      $config['upload_path'] = './assets/gambar/';
      $config['allowed_types'] = 'jpeg|jpg|png';
      $config['max_size']     = '2000';
      $this->upload->initialize($config);
      $field_name = "gambar";
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title' => 'Edit Data Barang',
          'kategori' => $this->m_kategori->get_all_data(),
          'barang' => $this->m_barang->get_data($id_barang),
          'error_upload' => $this->upload->display_errors(),
          'isi' => 'barang/v_edit'
        );
        $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $data = array(
          'id_barang' => $id_barang,
          'nama_barang' => $this->input->post('nama_barang'),
          'id_kategori' => $this->input->post('id_kategori'),
          'keterangan' => $this->input->post('keterangan'),
          'gambar' => $upload_data['uploads']['file_name'],
          'berat' => $this->input->post('berat'),
          'harga' => $this->input->post('harga'),
          'jumlah' => $this->input->post('jumlah'),
          'status' => $this->input->post('status'),
        );
        $this->m_barang->edit($data);
        $this->session->set_flashdata('sukses', 'Data berhasil diganti');
        redirect('barang');
      }
      $data = array(
        'id_barang' => $id_barang,
        'nama_barang' => $this->input->post('nama_barang'),
        'id_kategori' => $this->input->post('id_kategori'),
        'keterangan' => $this->input->post('keterangan'),
        'berat' => $this->input->post('berat'),
        'harga' => $this->input->post('harga'),
        'jumlah' => $this->input->post('jumlah'),
        'status' => $this->input->post('status'),
      );
      $this->m_barang->edit($data);
      $this->session->set_flashdata('sukses', 'Data berhasil diganti');
      redirect('barang');
    }


    $data = array(
      'title' => 'Edit Data Barang',
      'kategori' => $this->m_kategori->get_all_data(),
      'barang' => $this->m_barang->get_data($id_barang),
      'isi' => 'barang/v_edit'
    );
    $this->load->view('layouts/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_barang = NULL)
  {
    $barang =  $this->m_barang->get_data($id_barang);
    if ($barang->gambar != "") {
      unlink('./assets/gambar/' . $barang->gambar);
    }
    $data = array(
      'id_barang' => $id_barang,
    );
    $this->m_barang->delete($data);
    $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
    redirect('barang');
  }
}
  
  /* End of file barang.php */
