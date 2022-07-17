<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_user extends CI_Model
{

    var $table = 'tbl_user';
    var $column_order = array('username', 'full_name', 'id_level', 'image', 'is_active');
    var $column_search = array('username', 'full_name', 'id_level', 'is_active');
    var $order = array('id_user' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.nama_level');
        $this->db->join('tbl_userlevel b', 'a.id_level=b.id_level');
        $this->db->from('tbl_user a');
        $where = "a.id_level='1' or a.id_level='2'";
        $this->db->where($where);



        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {

        $this->db->from('tbl_user');
        return $this->db->count_all_results();
    }

    function view_user($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->get('tbl_user');
    }

    function getAll()
    {
        $this->db->select('a.*,b.nama_level');
        $this->db->join('tbl_userlevel b', 'a.id_level = b.id_level');
        $this->db->order_by('a.id_user desc');
        return $this->db->get('tbl_user a');
    }

    function cekUsername($username)
    {
        $this->db->where("username", $username);
        return $this->db->get("tbl_user");
    }

    function insertUser($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getUser($id)
    {
        $this->db->where("id_user", $id);
        return $this->db->get("tbl_user a")->row();
    }

    function updateUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }


    function deleteUsers($id, $table)
    {
        $this->db->where('id_user', $id);
        $this->db->delete($table);
    }

    function userlevel()
    {
        return $this->db->order_by('id_level ASC')
            ->get('tbl_userlevel')
            ->result();
    }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $id);
        return $this->db->get();
    }

    function reset_pass($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }
    public function gettotal($id)
    {
        $query = $this->db->query("
		select count(username) as total_siswa 
		from tbl_user 
		where id_level = " . $id . "
		");
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('simpanan'); // Untuk mengeksekusi perintah delete data
    }
    public function tahun_ajaran()
    {
        $query = $this->db->query("
		select * from 
        tahun_ajaran 
     
		");
        return $query;
    }


    function updatethajaran($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tahun_ajaran', $data);
    }
    public function detail_siswa($id)
    {
        $query = $this->db->query("
		select * from 
        siswa where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function siswa_all($id)
    {
        $query = $this->db->query("
		select s.*, tu.*, ta.tahun
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        left join tahun_ajaran ta
        on s.id_tahun=ta.id
        where s.no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function priodik($id)
    {
        $query = $this->db->query("
		select * from 
        priodik where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function ayah($id)
    {
        $query = $this->db->query("
		select * from 
        ayah where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function ibu($id)
    {
        $query = $this->db->query("
		select * from 
        ibu where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function wali($id)
    {
        $query = $this->db->query("
		select * from 
        wali where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    public function get_pdf($id)
    {
        $query = $this->db->query("
		select akta, kk, ktp from
        siswa where no_pendaftaran = '" . $id . "' 
		");
        return $query;
    }
    function accsiswa($id, $data)
    {
        $this->db->where('no_pendaftaran', $id);
        $this->db->update('siswa', $data);
    }
    public function status($id)
    {
        $query = $this->db->query("
		select * from 
        siswa where no_pendaftaran = " . $id . " 
		");
        return $query;
    }
    function getImageall($id)
    {
        $this->db->select('ktp, kk, akta');
        $this->db->from('siswa');
        $this->db->where('no_pendaftaran', $id);
        return $this->db->get();
    }
    function getktp($id)
    {
        $this->db->select('ktp');
        $this->db->from('siswa');
        $this->db->where('no_pendaftaran', $id);
        return $this->db->get();
    }

    function updatektp($id, $data)
    {
        $this->db->where('no_pendaftaran', $id);
        $this->db->update('siswa', $data);
    }
    function getkk($id)
    {
        $this->db->select('kk');
        $this->db->from('siswa');
        $this->db->where('no_pendaftaran', $id);
        return $this->db->get();
    }

    function updatekk($id, $data)
    {
        $this->db->where('no_pendaftaran', $id);
        $this->db->update('siswa', $data);
    }
    function getakta($id)
    {
        $this->db->select('akta');
        $this->db->from('siswa');
        $this->db->where('no_pendaftaran', $id);
        return $this->db->get();
    }

    function updateakta($id, $data)
    {
        $this->db->where('no_pendaftaran', $id);
        $this->db->update('siswa', $data);
    }
    public function pembayaran()
    {
        $query = $this->db->query("
		select * 
        from pembayaran p
        left join tahun_ajaran ta
        on p.id_tahun=ta.id
        where p.is_active = 'Y'
		");
        return $query;
    }

    function updatepembayaran($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pembayaran', $data);
    }
    public function view_pembayaran($no_pendaftaran)
    {
        $query = $this->db->query("
		select *
        from siswa s
        left join pembayaran p
        on s.golongan=p.golongan
        where s.no_pendaftaran = " . $no_pendaftaran . " and
        p.is_active = 'Y'
		");
        return $query;
    }
    public function tot_verfikasi()
    {
        $query = $this->db->query("
		select count(no_pendaftaran) as total_terverifikasi 
        from siswa where id_verivikasi = 1
		");
        return $query;
    }
    public function tot_belumverfikasi()
    {
        $query = $this->db->query("
		select count(no_pendaftaran) as total_belumterverifikasi 
        from siswa where id_verivikasi = 2
		");
        return $query;
    }
    public function tot_ditolak()
    {
        $query = $this->db->query("
		select count(no_pendaftaran) as total_ditolak 
        from siswa where id_verivikasi = 3
		");
        return $query;
    }
    public function view_all()
    {
        $query = $this->db->query("
		select s.*,tu.full_name, tu.username, ta.tahun, tu.no_tlp, a.nama_ayah, a.tempat_lahir as temp_ayah, a.tanggal_lahir as tgl_ayah, a.pendidikan, a.pekerjaan, 
        i.nama_ibu, i.tempat_lahir as temp_ibu, i.tanggal_lahir as tgl_ibu, i.pendidikan as pend_ibu, i.pekerjaan as pek_ibu,
        w.nama_wali, w.tempat_lahir as temp_wali, w.tanggal_lahir as tgl_wali, w.pendidikan as pend_wali, w.pekerjaan as pek_wali,
        p.tinggi_badan, p.berat_badan, p.jarak_kesekolah, p.waktu_kesekolah, p.saudara_kandung   
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        left join tahun_ajaran ta
        on s.id_tahun=ta.id
        left join ayah a
        on s.no_pendaftaran=a.no_pendaftaran
        left join ibu i
        on s.no_pendaftaran=i.no_pendaftaran
        left join priodik p
        on s.no_pendaftaran=p.no_pendaftaran
        left join wali w
        on s.no_pendaftaran=w.no_pendaftaran
        where id_verivikasi = 1
		");
        return $query;
    }

    public function siswa()
    {
        $query = $this->db->query("
		select * 
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        where id_verivikasi = 1
		");
        return $query;
    }
    public function view_by_siswa($id)
    {
        $query = $this->db->query("
		select s.*,tu.full_name, tu.username, ta.tahun, tu.no_tlp, a.nama_ayah, a.tempat_lahir as temp_ayah, a.tanggal_lahir as tgl_ayah, a.pendidikan, a.pekerjaan, 
        i.nama_ibu, i.tempat_lahir as temp_ibu, i.tanggal_lahir as tgl_ibu, i.pendidikan as pend_ibu, i.pekerjaan as pek_ibu,
        w.nama_wali, w.tempat_lahir as temp_wali, w.tanggal_lahir as tgl_wali, w.pendidikan as pend_wali, w.pekerjaan as pek_wali,
        p.tinggi_badan, p.berat_badan, p.jarak_kesekolah, p.waktu_kesekolah, p.saudara_kandung   
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        left join tahun_ajaran ta
        on s.id_tahun=ta.id
        left join ayah a
        on s.no_pendaftaran=a.no_pendaftaran
        left join ibu i
        on s.no_pendaftaran=i.no_pendaftaran
        left join priodik p
        on s.no_pendaftaran=p.no_pendaftaran
        left join wali w
        on s.no_pendaftaran=w.no_pendaftaran
        where id_verivikasi = 1 and tu.id_user = " . $id . "
		");
        return $query;
    }

    public function view_by_golongan($golongan)
    {
        $query = $this->db->query("
		select s.*,tu.full_name, tu.username, ta.tahun, tu.no_tlp, a.nama_ayah, a.tempat_lahir as temp_ayah, a.tanggal_lahir as tgl_ayah, a.pendidikan, a.pekerjaan, 
        i.nama_ibu, i.tempat_lahir as temp_ibu, i.tanggal_lahir as tgl_ibu, i.pendidikan as pend_ibu, i.pekerjaan as pek_ibu,
        w.nama_wali, w.tempat_lahir as temp_wali, w.tanggal_lahir as tgl_wali, w.pendidikan as pend_wali, w.pekerjaan as pek_wali,
        p.tinggi_badan, p.berat_badan, p.jarak_kesekolah, p.waktu_kesekolah, p.saudara_kandung   
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        left join tahun_ajaran ta
        on s.id_tahun=ta.id
        left join ayah a
        on s.no_pendaftaran=a.no_pendaftaran
        left join ibu i
        on s.no_pendaftaran=i.no_pendaftaran
        left join priodik p
        on s.no_pendaftaran=p.no_pendaftaran
        left join wali w
        on s.no_pendaftaran=w.no_pendaftaran
        where id_verivikasi = 1 and s.golongan = '" . $golongan . "'
		");
        return $query;
    }
    public function view_by_tahun_ajaran($tahun)
    {
        $query = $this->db->query("
		select s.*,tu.full_name, tu.username, ta.tahun, tu.no_tlp, a.nama_ayah, a.tempat_lahir as temp_ayah, a.tanggal_lahir as tgl_ayah, a.pendidikan, a.pekerjaan, 
        i.nama_ibu, i.tempat_lahir as temp_ibu, i.tanggal_lahir as tgl_ibu, i.pendidikan as pend_ibu, i.pekerjaan as pek_ibu,
        w.nama_wali, w.tempat_lahir as temp_wali, w.tanggal_lahir as tgl_wali, w.pendidikan as pend_wali, w.pekerjaan as pek_wali,
        p.tinggi_badan, p.berat_badan, p.jarak_kesekolah, p.waktu_kesekolah, p.saudara_kandung   
        from siswa s
        left join tbl_user tu
        on s.no_pendaftaran=tu.id_user
        left join tahun_ajaran ta
        on s.id_tahun=ta.id
        left join ayah a
        on s.no_pendaftaran=a.no_pendaftaran
        left join ibu i
        on s.no_pendaftaran=i.no_pendaftaran
        left join priodik p
        on s.no_pendaftaran=p.no_pendaftaran
        left join wali w
        on s.no_pendaftaran=w.no_pendaftaran
        where id_verivikasi = 1 and s.id_tahun = '" . $tahun . "'
		");
        return $query;
    }
    public function tahun()
    {
        $query = $this->db->query("
		select * 
        from tahun_ajaran
		");
        return $query;
    }
}
