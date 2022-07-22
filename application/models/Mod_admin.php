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

    public function verivikasi()
    {
        $query = $this->db->query("
        select s.*, tu.full_name, tu.username 
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        where s.id_verivikasi != '1'
        order by s.id_verivikasi desc
        ");
        return $query;
    }
    public function verifikasiacc()
    {
        $query = $this->db->query("
        select s.*, tu.full_name, tu.username 
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        where s.id_verivikasi = '1' 
        order by s.id_verivikasi desc
        ");
        return $query;
    }
}
