<?php

function cek_login()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $roleId = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();

        $menu_id = $queryMenu['user_menu_id'];

        $useraccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $roleId,
            'menu_id' => $menu_id
        ]);

        if ($useraccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}
