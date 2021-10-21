<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{
    public function getAbsenByKelas($id, $kelas)
    {
        $query = $this->db->query("SELECT absen.*, pengasuh.`nama`, kelas.*, mapel.`mapel`, santri.`nama`
        FROM absen JOIN pengasuh
        ON absen.`guru_id` = pengasuh.`id_pengasuh`
        JOIN kelas ON absen.`kelas_id` = kelas.`id_kelas`
        JOIN mapel ON absen.`mapel_id` = mapel.`id_mapel`
        JOIN santri ON absen.`user_id` = santri.`id_santri`
        WHERE absen.`guru_id` = $id
        AND absen.`kelas_id` = $kelas")->result();
        return $query;
    }
    
     public function getAllabsenByID()
    {
        $id = $this->session->userdata('nip');

        $nilai = $this->db->query("SELECT absen.*, santri.`nama`,santri.`nis`, mapel.`mapel`
        FROM absen
        JOIN santri ON absen.`user_id` = santri.`nis`
        JOIN mapel ON absen.`mapel_id` = mapel.`id_mapel`
        WHERE absen.`user_id`= $id");

        return $nilai;
    }
}
