<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
  public function simpan_pesanan($data_pesanan)
  {
    $this->db->insert('tbl_pesanan', $data_pesanan);
  }
  public function simpan_detail($data_detail)
  {
    $this->db->insert('tbl_pesanan_detail', $data_detail);
  }
  public function simpan_pengiriman($data)
  {
    $this->db->insert('tbl_pengiriman', $data);
  }
  public function semua_pesanan()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function belum_bayar()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 0);
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function verifikasi()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 1);
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function proses()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 2);
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function kirim()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 3);
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function selesai()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 4);
    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function simpan_konfirmasi($simpan_konfirmasi)
  {
    $this->db->insert('tbl_konfirmasi', $simpan_konfirmasi);
  }
  public function konfirmasi($pesanan_id)
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('tbl_pesanan.pesanan_id', $pesanan_id);
    return $this->db->get()->row();
  }
  public function ubah_jumlah($pesanan_id)
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    $this->db->join('tbl_barang', 'tbl_pesanan_detail.barang_id = tbl_barang.id_barang', 'left');
    $this->db->where('tbl_pesanan.pesanan_id', $pesanan_id);
    return $this->db->get()->result();
  }
  public function update_jumlah($update_jml,)
  {
    $this->db->where('id_barang', $update_jml['id_barang']);
    $this->db->update('tbl_barang', $update_jml);
  }
  public function update_status($update)
  {
    $this->db->where('pesanan_id', $update['pesanan_id']);
    $this->db->update('tbl_pesanan', $update);
  }
  public function detail()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    return $this->db->get()->result();
  }
}
