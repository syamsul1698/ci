<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mengajar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('pengasuh_model', 'pengasuh');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('mengajar_model', 'mengajar');
        $this->load->model('mapel_model', 'mapel');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['pengasuhs'] = $this->pengasuh->getAllPengasuh();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Mengajar';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('pengasuh/mengajar/index', $data);
        $this->load->view('templates/user_footer');
    }
    
     public function tambah()
    {
        $data['user'] = $this->auth->getSession();
        $data['pengasuh'] = $this->pengasuh->getAllPengasuhbyrow();
        $data['kelas'] = $this->kelas->getAllKelasByAsc()->result();
        $data['mapel'] = $this->mapel->getMapel();
        $data['mengajar'] = $this->mengajar->getAllMengajar();


        $data['judul'] = 'Mengajar';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('pengasuh/mengajar/tambah', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambahdata()
    {
        $id = $this->input->post('id');
        $mengajar = [
            'kelas_id' => htmlspecialchars($this->input->post('kelas', true)),
            'pengasuh_id' => htmlspecialchars($this->input->post('id', true)),
            'mapel_id' => htmlspecialchars($this->input->post('mapel', true)),
        ];

        $this->db->insert('mengajar', $mengajar);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data telah Ditambahkan</div>');
        redirect("mengajar/tambah/$id");
    }
}
