<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
  public function harian($tanggal)
  {
    $this->db->select('*');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    $this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_pesanan_detail.barang_id', 'left');
    $this->db->where('DATE(tbl_pesanan.tanggal_pesan)', $tanggal);
    return $this->db->get()->result();
  }
  public function bulanan($bulan)
  {
    $this->db->select('*, SUM(tbl_pesanan_detail.qty) AS tot_qty,SUM(tbl_pesanan_detail.subtotal) AS tot_sub, COUNT(DISTINCT tbl_pesanan_detail.barang_id) AS tot_prod, ');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    $this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_pesanan_detail.barang_id', 'left');
    $this->db->where('MONTH(tbl_pesanan.tanggal_pesan)', $bulan);
    $this->db->where('tbl_pesanan.status', 1);
    $this->db->group_by('tbl_pesanan.tanggal_pesan');
    return $this->db->get()->result();
  }
  public function tahunan($tahun)
  {
    $this->db->select('* ,SUM(tbl_pesanan_detail.subtotal) AS tot_sub');
    $this->db->from('tbl_pesanan');
    $this->db->join('tbl_pesanan_detail', 'tbl_pesanan_detail.no_order = tbl_pesanan.no_order', 'left');
    $this->db->where('YEAR(tbl_pesanan.tanggal_pesan)', $tahun);
    $this->db->where('tbl_pesanan.status', 1);
    $this->db->group_by('substr(tbl_pesanan.tanggal_pesan,5,2)');

    return $this->db->get()->result();
  }
}
