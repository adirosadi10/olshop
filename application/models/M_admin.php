<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
  public function chart()
  {
    $tahun = date("Y");
    $query = "SELECT nama, tqty FROM tbl_bulan LEFT JOIN ( SELECT MONTH(tanggal_pesan) as bulan , SUM(subtotal) as tqty from tbl_pesanan inner join tbl_pesanan_detail on tbl_pesanan_detail.no_order = tbl_pesanan.no_order where YEAR(tanggal_pesan) = $tahun and status != 0 group by MONTH(tanggal_pesan)) tbl_pesanan on bulan = tbl_bulan.urut";
    return $this->db->query($query);
  }
  public function total_barang()
  {
    return $this->db->get('tbl_barang')->num_rows();
  }
  public function pesanan_baru()
  {

    $this->db->where('status', 1);
    return $this->db->get('tbl_pesanan')->num_rows();
  }
  public function total_kategori()
  {
    return $this->db->get('tbl_kategori')->num_rows();
  }
  public function data_setting()
  {
    $this->db->select('*');
    $this->db->from('tbl_setting');
    $this->db->where('id', 1);
    return $this->db->get()->row();
  }
  public function edit($data)
  {
    $this->db->where('id', 1);
    $this->db->update('tbl_setting', $data);
  }
  public function data_bank()
  {
    $this->db->select('*');
    $this->db->from('tbl_bank');
    return $this->db->get()->result();
  }
  public function hari_ini()
  {
    $tanggals = "2021-05-16";
    $tanggal = date('Y-m-d');
    $this->db->select('SUM(tbl_pesanan_detail.subtotal) as tqty');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    $this->db->where('tbl_pesanan.tanggal_pesan', $tanggal);
    $this->db->where('status !=0');
    $this->db->group_by('tanggal_pesan');

    return $this->db->get()->row_array();
  }
}
