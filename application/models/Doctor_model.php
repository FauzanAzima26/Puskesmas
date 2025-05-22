<?php
class Doctor_model extends CI_Model
{
  public function insert($data)
  {
    return $this->db->insert('tb_dokter', $data);
  }

  public function get_all()
  {
    return $this->db->get('tb_dokter')->result();
  }

}
