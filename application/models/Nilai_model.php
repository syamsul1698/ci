<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    public function getnilai()
    {
        $nilai = $this->db->get('nilai')->result();
        return $nilai;
    }

    public function exportNilaiByKelas($id)
    {;

        $guru = $this->session->userdata('nip');

        $query = $this->db->query("SELECT nilai.*, kelas.`kelas` AS nama_kelas, pengasuh.`nama`, santri.`nama`
        FROM nilai JOIN pengasuh
        ON nilai.`guru_id` = pengasuh.`id_pengasuh`
        JOIN kelas ON nilai.`kelas_id` = kelas.`id_kelas`
        JOIN santri ON nilai.`user_id` = santri.`id_santri`
        WHERE nilai.`kelas_id`= $id 
        AND nilai.`guru_id` = $guru
        ORDER BY santri.`nama` ASC");

        return $query;
        
    }

    public function getNilaiById()
    {
        $id = $this->session->userdata('nip');

        $nilai = $this->db->query("SELECT nilai.*, santri.`nama`, mapel.`mapel`,santri.`nis`
        FROM nilai
        JOIN santri ON nilai.`user_id` = santri.`nis`
        JOIN mapel ON nilai.`mapel_id` = mapel.`id_mapel`
        WHERE nilai.`user_id`= $id");

        return $nilai;
    }
}
