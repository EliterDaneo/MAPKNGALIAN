<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function berita($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function total_berita()
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'desc');
        return $this->db->get()->result();
    }

    public function detail_berita($slug_berita)
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->where('slug_berita', $slug_berita);
        return $this->db->get()->row();
    }

    public function limit_berita()
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'desc');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function slider_berita()
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'desc');
        $this->db->limit(4);
        return $this->db->get()->result();
    }

    public function detailTentang()
    {
        $this->db->select('*');
        $this->db->from('tbl_seting');
        $this->db->order_by('id', 1);
        return $this->db->get()->row();
    }

    public function galery()
    {
        $this->db->select('tbl_galery.*,count(tbl_foto.id_galery)as jml_foto');
        $this->db->from('tbl_galery');
        $this->db->join('tbl_foto', 'tbl_foto.id_galery = tbl_galery.id_galery', 'left');
        $this->db->group_by('tbl_galery.id_galery');
        $this->db->order_by('tbl_galery.id_galery', 'DESC');
        return $this->db->get()->result();
    }

    public function detail_galery($id_galery)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('id_galery', $id_galery);
        $this->db->order_by('foto', 'DESC');
        return $this->db->get()->result();
    }

    public function pengumuman()
    {
        $this->db->select('*');
        $this->db->from('tbl_pengumuman');
        $this->db->order_by('id_pengumuman', 'desc');
        return $this->db->get()->result();
    }

    public function guru()
    {
        $this->db->select('*');
        $this->db->from('tbl_guru');
        $this->db->join('tbl_mapel', 'tbl_mapel.id_mapel = tbl_guru.id_mapel', 'left');
        $this->db->order_by('id_guru', 'desc');
        return $this->db->get()->result();
    }

    public function siswa()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.kelas');
        $this->db->order_by('id_siswa', 'DESC');
        return $this->db->get()->result();
    }

    public function sarpras()
    {
        $this->db->select('*');
        $this->db->from('tbl_sarpras');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_sarpras.id_user', 'left');
        $this->db->order_by('id_sarpras', 'DESC');
        return $this->db->get()->result();
    }

    //model Home
    public function download()
    {
        $this->db->select('*');
        $this->db->from('tbl_file');
        $this->db->order_by('id_file', 'DESC');
        return $this->db->get()->result();
    }

    public function nama_galery($id_galery)
    {
        $this->db->select('*');
        $this->db->from('tbl_galery');
        $this->db->where('id_galery', $id_galery);
        return $this->db->get()->row();
    }

    //lastes berita
    public function update()
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'desc');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
}