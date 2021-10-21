<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mengajar_model extends CI_Model
{
    
    public function getAllMengajarkelas()
    {
        
        $role = $this->session->userdata('nip');

         $mengajar = $this->db->query("SELECT mengajar.`kelas_id`, mengajar.`pengasuh_id`, mengajar.`id_mengajar`, pengasuh.`nama`, pengasuh.`nama` AS nama_guru, mapel.*, pengasuh.`id_pengasuh`, kelas.`kelas` AS nama_kelas, pengasuh.`nip`
        FROM mengajar JOIN pengasuh
        ON mengajar.`pengasuh_id` = pengasuh.`nip`
        JOIN kelas ON mengajar.`kelas_id` = kelas.`id_kelas`
        join mapel ON mengajar.`mapel_id` = mapel.`id_mapel`
        WHERE mengajar.`pengasuh_id` = $role
        ORDER BY kelas.`kelas` ASC");
        return $mengajar;
    }
    
    public function getAllMengajar()
    {
         $id = $this->uri->segment(3);

        $mengajar = $this->db->query("SELECT mengajar.`kelas_id`, mengajar.`pengasuh_id`, mengajar.`id_mengajar`, pengasuh.`nama`, pengasuh.`nama` AS nama_guru, mapel.*, pengasuh.`id_pengasuh`, kelas.`kelas` AS nama_kelas, pengasuh.`nip`
        FROM mengajar JOIN pengasuh
        ON mengajar.`pengasuh_id` = pengasuh.`nip`
        JOIN kelas ON mengajar.`kelas_id` = kelas.`id_kelas`
        join mapel on mengajar.`mapel_id` = mapel.`id_mapel`
        WHERE mengajar.`pengasuh_id` = $id");
        return $mengajar;
    }
}
