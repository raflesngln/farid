<?php
class My_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
//=====================login member cek============================
    function login_admin($table,$username,$password) {
		
	$query=$this->db->query("select*from ".$table." where nik='$username' and password='$password'");		
	return $query->result();
    }
//=====================login karyawan============================
    function login_karyawan($table,$username,$password) {
		
	$query=$this->db->query("select*from ".$table." where nik='$username' and password='$password'");		
	return $query->result();
    }
	
public function generateNo($table,$kolom,$kd_unik)
    {
		$bulan=date('m');
        $query = $this->db->query("select MAX(RIGHT($kolom,5)) as kd_max from $table WHERE MID($kolom,8,2)='$bulan'");
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = "00001";
        }
        return $kd_unik.date('Ym').$kd;
    }


	
//=================== DELETEA ===============================

		function delete_data($table,$kolom,$id)
	{
		$this->db->where($kolom,$id);
		$this->db->delete($table);
	}	
//=================== DELETEA ===============================

		function delete_multi_condition($table,$array)
	{
		$this->db->where($array);
		$this->db->delete($table);
	}	

//=================== select1 ===============================

		function select1($table,$kolom,$id)
	{
		 $query = $this->db->query("select*from $table where $kolom='$id'");
		return $query->result();
	}	
//========================INSERT ========================
public function insert($table,$data) {
	 $this->db->insert($table,$data);
    }
//=====================get data all============================
    public function selectall($tabel)
    {
        $query = $this->db->query("select*from ".$tabel."");
		return $query->result();
    }
	//=====================get data all============================
    public function getdata($tabel,$where)
    {
        $query = $this->db->query("select * from ".$tabel." $where");
		return $query->result();
    }
	//=====================get data all============================
    public function getDataMessage($kolom,$tabel,$where)
    {
        $query = $this->db->query("select ".$kolom." from ".$tabel." $where");
		return $query->result();
    }
		//=====================get data all============================
    public function getDataMessageeeeeee($kolom1,$kolom2,$tabel1,$tabel2)
    {
		$this->db->select('a.id_pengirim,a.id_penerima,a.pesan,a.lampiran,a.tgl_kirim,a.pesan,b.nik,b.nama as penerima', FALSE);
	    $this->db->from($tabel1);
		$this->db->join($tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->group_by('b.nama');
		$query = $this->db->get();
		return $query->result();

    }
		//=====================get data all============================
    public function getdata2($kolom,$tabel,$where)
    {
        $this->db->select('a.id_pengirim,a.id_penerima');
		$this->db->from('pesan a');
		$this->db->join('karyawan b', 'a.id_pengirim = b.id_karyawan');
		$query = $this->db->get();
		return $query->result();

    }

		//=====================get data all============================
    public function getdatapaging($kolom,$tabel,$where)
    {
        $query = $this->db->query("select ".$kolom." from ".$tabel." $where");
		return $query->result();
    }

//=============== Hitung isi tabel===============================
		function hitung_isi_tabel($kolom,$tabel,$seleksi)
	{
		$q = $this->db->query("SELECT ".$kolom." from ".$tabel." $seleksi");
		return $q;
	}	
//===============VIEW kwitansi WITH PAGING=============================
		function getdatapaginggggg($limit,$offset,$where)
	{
		$q = $this->db->query("SELECT * from surat_tugas a 
		inner join lhs b on a.id_surat_tugas=b.id_surat_tugas 
		inner join surveyor c on a.id_pegawai=c.id_pegawai
		inner join asuransi d on a.id_asuransi=d.id_asuransi
		$where
		order by b.id_lhs DESC LIMIT $offset,$limit");
		return $q->result();
	}
//=====================get data all============================
    public function select_id($tabel,$kolom,$id)
    {
        $query = $this->db->query("select*from ".$tabel." a 
		inner join transaction_details b on a.transc_id=b.transc_id
		inner join customer c on a.custCode=c.custCode
		where a.transc_id='$id'
		");
		return $query->result();
    }



//====================UPDATE data=====================================	 
	    function update($table,$kolom,$id,$data)
	    {
	      $this->db->where($kolom,$id);
	       $ubah= $this->db->update($table,$data);
			return $ubah;
	    }



	//=====================get data all============================
    public function selectedid($tabel,$where)
    {
        $query = $this->db->query("select*from ".$tabel." a
		right join asuransi c on a.id_asuransi=c.id_asuransi
		 $where ");
		return $query->result();
    }
		

    function get_datatables3($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2)
    {
        $this->db->select('a.NoSMU,a.ETD,a.Origin,a.Destination,a.Shipper,a.Consigne,a.PCS,a.CWT,a.FinalCWT,a.Consolidation,a.StatusProses,b.CustName as sender,c.CustName as receiver,d.PortName as ori,e.PortName as desti', FALSE);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
        $this->db->join("ms_customer c",'a.Shipper=c.CustCode','LEFT');
        $this->db->join("ms_port d",'a.Origin=d.PortCode','LEFT');
        $this->db->join("ms_port e",'a.Destination=e.PortCode','LEFT');
        $this->_get_datatables_query3($nm_coloum,$orderby,$where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	

	//========================INSERT ========================
public function backup($folder,$table) {
      $query = $this->db->query("SELECT * INTO OUTFILE ".$folder." FROM $table");
      return $query->result();
    }
	

    public function countRecord($id)
    {
        $query = $this->db->query("select count(id_kategori) as jml from diskusi where id_kategori='$id'");
		return $query->result();
		
/*		$this->db->select($kolom);
		$this->db->group_by('id_kategori');
		$this->db->get($tabel);
		*/
    }
	//=====================get data all============================
    public function getdata5($kolom,$tabel,$where)
    {
        $query = $this->db->query("select ".$kolom." from ".$tabel." $where");
		return $query->result();
    }
	
		
}