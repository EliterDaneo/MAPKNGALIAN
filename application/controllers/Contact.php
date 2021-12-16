<?php
class Contact extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('admin_model');
        $this->load->model('home_model');
    }
    function index()
    {
        $data = array(
            'seting' => $this->admin_model->detailSettings(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'v_home',
            'berita' => $this->home_model->slider_berita(),
            'news'    => $this->home_model->news(),
        );
        $this->load->view('home/layout/v_wrapper', $data, FALSE);
    }

    function kirim_pesan()
    {
        $nama = htmlspecialchars($this->input->post('xnama', TRUE), ENT_QUOTES);
        $email = htmlspecialchars($this->input->post('xemail', TRUE), ENT_QUOTES);
        $kontak = htmlspecialchars($this->input->post('xphone', TRUE), ENT_QUOTES);
        $pesan = htmlspecialchars($this->input->post('xmessage', TRUE), ENT_QUOTES);
        $this->contact_model->kirim_pesan($nama, $email, $kontak, $pesan);
        echo $this->session->set_flashdata('msg', '<p><strong> NB: </strong> Terima Kasih Telah Menghubungi Kami.</p>');
        redirect('home');
    }
}
