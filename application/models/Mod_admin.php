<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }
    public function admin()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '1'
        ");
        return $query;
    }
    public function pegawai()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '2'
        ");
        return $query;
    }

    public function anggota()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function total_simpanan($nik)
    {
        $query = $this->db->query("
         select sum(jumlah) as jumlah
        from simpanan
        where nik = " . $nik . "
        ");
        return $query;
    }
    public function pinjaman()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        ");
        return $query;
    }
    public function nama_peminjam()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
}
