<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('santri_model', 'santri');
    }
    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['santri'] = $this->santri->getAllSantri();
        $data['status'] = $this->santri->joinstatus();

        $data['judul'] = 'Status Pembayaran';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('santri/status/status', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit($id)
    {
        $data['user'] = $this->auth->getSession();
        $data['santri'] = $this->santri->getSantriById($id);
        $data['status'] = $this->db->get('status')->result();

        $data['judul'] = 'Status Pembayaran';


        $this->form_validation->set_rules('status', 'Satus Pembayaran', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('santri/status/edit', $data);
            $this->load->view('templates/user_footer');
        } else {
            $id = $this->input->post('id');
            $status = ['status_bayar' => $this->input->post('status')];

            $this->db->where('id_santri', $id);
            $this->db->update('santri', $status);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data telah Ditambahkan, Silahkan Login</div>');
            redirect('status');
        }
    }
}
