<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Home extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        /*-- untuk mengatasi error confirm form resubmission  --*/
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        $this->load->model('home_model');
        $this->load->model('contact_model');
        $this->load->model('admin_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'Website Ma',
            'parent' => 'Akademik',
            'page'  => 'Home Website',
            'isi'   => 'v_home',
            'berita' => $this->home_model->slider_berita(),
            'sarana' => $this->admin_model->sarpras(),
            'sarpras' => $this->home_model->sarpras(),
            'logo' => $this->admin_model->detailLogo(),
            'guru' => $this->home_model->guru(),
            'update' => $this->home_model->update(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'tot_guru' => $this->db->get('tbl_guru')->num_rows(),
            'tot_siswa' => $this->db->get('tbl_siswa')->num_rows(),
            'tot_files' => $this->db->get('tbl_file')->num_rows(),
            'tot_pengumuman' => $this->db->get('tbl_pengumuman')->num_rows(),
        );
        $this->load->view('Home/Layout/v_wrapper_home', $data, FALSE);
    }

    //controler kontak
    public function kontak()
    {
        $data = array(
            'title' => 'Website Ma',
            'parent' => 'Akademik',
            'page'  => 'Home Website',
            'isi'   => 'Home/settingsHome/v_kontak',
            'berita' => $this->home_model->slider_berita(),
            'sarana' => $this->admin_model->sarpras(),
            'sarpras' => $this->home_model->sarpras(),
            'logo' => $this->admin_model->detailLogo(),
            'guru' => $this->home_model->guru(),
            'update' => $this->home_model->update(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'tot_guru' => $this->db->get('tbl_guru')->num_rows(),
            'tot_siswa' => $this->db->get('tbl_siswa')->num_rows(),
            'tot_files' => $this->db->get('tbl_file')->num_rows(),
            'tot_pengumuman' => $this->db->get('tbl_pengumuman')->num_rows(),
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    //controler guru
    public function guru()
    {
        $data = array(
            'parent' => 'Daftar Guru',
            'title' => 'MA PK MAARIF NGALIAN',
            'guru' => $this->home_model->guru(),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_guru'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function berita()
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url('Home/settingsHome/v_berita');
        $config['total_rows'] = count($this->home_model->total_berita());
        $config['per_page'] = 8;
        $config['url_segmen'] = 3;
        $limit = $config['per_page'];
        $start = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        //....
        $config['first_link']    = 'first';
        $config['last_link']    = 'last';
        $config['next_link']    = 'next';
        $config['priview_link']    = 'priview';
        $config['full_tag_open']    = '<div class="pagination_container d-flex flex-row align-items-center justify-content-start text-center"><ul class="pagination_list">';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']        = '<li class="active"><a></a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_open']        = '</li>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']        = '</li>';
        $config['firts_tag_open']        = '<li>';
        $config['firts_tag_close']        = '</li>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']        = '</li>';
        $config['full_tag_close']        = '</ul></div>';
        //......
        $this->pagination->initialize($config);

        $data = array(
            'pagination' => $this->pagination->create_links(),
            'limit_berita' => $this->home_model->limit_berita(),
            'guru' => $this->home_model->guru(),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'berita'    => $this->home_model->berita($limit, $start),
            'update' => $this->home_model->update(),
            'title' => 'Data Berita',
            'isi' => 'Home/settingsHome/v_berita'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function detail_berita($slug_berita)
    {
        $data = array(
            'title' => 'Detail Berita',
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'limit_berita' => $this->home_model->limit_berita(),
            'guru' => $this->home_model->guru(),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur' => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'beritaBerita' => $this->home_model->detail_berita($slug_berita),
            'sideBerita' => $this->home_model->update(),
            'isi' => 'Home/v_detailBerita'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function tentang()
    {
        $data = array(
            'title' => 'Profile Sekolah',
            'sekolah' => $this->home_model->detailTentang(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'isi' => 'v_home'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function siswa()
    {
        $data = array(
            'title' => 'Data Siswa',
            'siswa' => $this->home_model->siswa(),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_siswa'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function galery()
    {
        $data = array(
            'parent' => 'Daftar Galery',
            'title' => 'MA PK MAARIF NGALIAN',
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_galery'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function detail_galery($id_galery)
    {
        $data = array(
            'title' => 'Detail Galery',
            'foto' => $this->home_model->detail_galery($id_galery),
            'nama_galery' => $this->home_model->nama_galery($id_galery),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'news'    => $this->home_model->news(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_detailGalery'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function pengumuman()
    {
        $data = array(
            'title' => 'Pengumuman Sekolah',
            'parent' => 'Website MA PK MAARIF NGALIAN',
            'pengumuman' => $this->home_model->pengumuman(),
            'galery' => $this->home_model->galery(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_pengumuman'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function sarpras()
    {
        $data = array(
            'parent' => 'Daftar Guru',
            'title' => 'MA PK MAARIF NGALIAN',
            'guru' => $this->home_model->guru(),
            'galery' => $this->home_model->galery(),
            'sarana' => $this->admin_model->sarpras(),
            'sarpras' => $this->home_model->sarpras(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_sarpras'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    //controler dwonload
    public function download()
    {
        $data = array(
            'parent' => 'Download Area',
            'title' => 'MA PK MAARIF NGALIAN',
            'download' => $this->home_model->download(),
            'guru' => $this->home_model->guru(),
            'galery' => $this->home_model->galery(),
            'sarana' => $this->admin_model->sarpras(),
            'sarpras' => $this->home_model->sarpras(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'berita' => $this->home_model->slider_berita(),
            'logo' => $this->admin_model->detailLogo(),
            'seting' => $this->admin_model->detailSettings(),
            'struktur'     => $this->admin_model->detailstruktur(),
            'sekolah' => $this->admin_model->detailSettings(),
            'isi' => 'Home/settingsHome/v_download'
        );
        $this->load->view('Home/Layout/v_wrapper', $data, FALSE);
    }

    public function blocked()
    {

        $data['title'] = "Acces Forbidden";
        $this->load->view('Home/home_403', $data);
    }
}