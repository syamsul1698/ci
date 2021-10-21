<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengasuh_model extends CI_Model
{
    public function getAllPengasuh()
    {
        return $this->db->get_where('pengasuh',['role_id' => 2])->result();
    }
    
    public function getAllPengasuhbyrow()
    {
        $id = $this->uri->segment(3);
        $nip = $this->session->userdata('nip');
      return 
        $this->db->query("SELECT  pengasuh.*, mapel.`mapel` AS matapelajaran
                        FROM pengasuh
                        JOIN mapel ON pengasuh.`mengajar` = mapel.`id_mapel`
                        WHERE nip = $id");
    }


    public function getPengasuhById($id)
    {
        return $this->db->get_where('pengasuh', ['id_pengasuh' => $id]);
    }
    
    public function getPengasuhBynip()
    {
        $nip = $this->session->userdata('nip');
        return $pengasuh = $this->db->get_where('pengasuh', ['nip' => $nip]);
    }
    
    
}
