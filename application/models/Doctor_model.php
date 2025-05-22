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

  public function get_by_id($id)
  {
    return $this->db->get_where('tb_dokter', ['id_dokter' => $id])->row();
  }

  public function update($id, $data)
  {
    $this->db->where('id_dokter', $id);
    return $this->db->update('tb_dokter', $data);
  }


}
