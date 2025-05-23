<?php
class Antrian_model extends CI_Model
{
    public function get_today_by_pasien($id_pasien)
    {
        return $this->db->get_where('tb_antrian', [
            'id_pasien' => $id_pasien,
            'tanggal' => date('Y-m-d')
        ])->row();
    }

    public function get_last_number_today()
    {
        $this->db->select_max('nomor_antrian');
        $this->db->where('tanggal', date('Y-m-d'));
        $result = $this->db->get('tb_antrian')->row();

        return $result->nomor_antrian ?? 0; 
    }

    public function insert($data)
    {
        return $this->db->insert('tb_antrian', $data);
    }
}
