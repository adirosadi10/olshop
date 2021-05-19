<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_bank extends CI_Model
{

  public function get_all_data()
  {
    $this->db->select('*');
    $this->db->from('tbl_bank');
    $this->db->order_by('id_bank', 'asc');
    return $this->db->get()->result();
  }
  public function add($data)
  {
    $this->db->insert('tbl_bank', $data);
  }
  public function edit($data)
  {
    $this->db->where('id_bank', $data['id_bank']);
    $this->db->update('tbl_bank', $data);
  }
  public function delete($data)
  {
    $this->db->where('id_bank', $data['id_bank']);
    $this->db->delete('tbl_bank', $data);
  }
}
  
  /* End of file M_bank.php */
