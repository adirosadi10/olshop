<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model
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
    $this->db->join('tbl_pengiriman', 'tbl_pengiriman.no_order = tbl_pesanan.no_order', 'left');
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function belum_bayar()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 0);
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function verifikasi()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 1);
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function diproses()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 2);
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function dikirim()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 3);
    $this->db->order_by('pesanan_id', 'desc');
    return $this->db->get()->result();
  }
  public function selesai()
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->where('status', 4);
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
  public function update_status($update)
  {
    $this->db->where('pesanan_id', $update['pesanan_id']);
    $this->db->update('tbl_pesanan', $update);
  }
  public function detail_bayar()
  {
    $this->db->select('tbl_pesanan.*, tbl_konfirmasi.konfirmasi_id, tbl_konfirmasi.bank, tbl_konfirmasi.no_rekening, tbl_konfirmasi.atas_nama, tbl_konfirmasi.bukti_transfer, tbl_konfirmasi.catatan');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_konfirmasi', 'tbl_pesanan.no_order = tbl_konfirmasi.no_order', 'left');
    return $this->db->get()->result();
  }
}
