<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

  public function get_all_data()
  {
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->order_by('user_id', 'desc');
    return $this->db->get()->result();
  }
  public function add($data)
  {
    $this->db->insert('tbl_user', $data);
  }
  public function edit($data)
  {
    $this->db->where('user_id', $data['user_id']);
    $this->db->update('tbl_user', $data);
  }
  public function delete($data)
  {
    $this->db->where('user_id', $data['user_id']);
    $this->db->delete('tbl_user', $data);
  }
}
  
  /* End of file M_user.php */
