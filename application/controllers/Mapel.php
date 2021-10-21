<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('mengajar_model', 'mengajar');
        $this->load->model('santri_model', 'santri');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('mapel_model', 'mapel');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['mapel'] = $this->mapel->getMapel();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Mata Pelajaran';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar');
        $this->load->view('mapel/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {
        $mapel = ['mapel' => $this->input->post('mapel')];
        $this->db->insert('mapel', $mapel);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Ditambah</div>');
        redirect('mapel');
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $mapel = ['mapel' => $this->input->post('mapel')];

        $this->db->where('id_mapel', $id);
        $this->db->update('mapel', $mapel);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Ditambah</div>');
        redirect('mapel');
    }

    public function hapus($id)
    {
        $this->db->where('id_mapel', $id);
        $this->db->delete('mapel');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Dihapus</div>');
        redirect('mapel');
    }
}
