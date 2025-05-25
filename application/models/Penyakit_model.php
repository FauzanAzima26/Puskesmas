<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit_model extends CI_Model
{

    private $table = 'tb_penyakit';

    public function get_datatables()
    {
        $this->db->select('*');
        $this->db->from('tb_penyakit');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_penyakit', $id);
        $query = $this->db->get('tb_penyakit');
        return $query->row(); // Mengembalikan single object
    }

    public function insert($data)
    {
        return $this->db->insert('tb_penyakit', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_penyakit', $id);
        return $this->db->update('tb_penyakit', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_penyakit', $id);
        return $this->db->delete('tb_penyakit');
    }
}
