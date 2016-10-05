<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
		$this->load->model('m_karyawan');
		$this->load->model('my_model');
	}

    function index(){
       	  $data=array(
		  'crumb'=>'karyawan',
		  'title'=>'<i class="fa fa-users"></i> Data Karyawan',
		  'view'=>'admin/v_karyawan'
		  );
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='karyawan a';
		$nm_tabel2='jabatan b';
		$kolom1='a.id_jabatan';
		$kolom2='b.id_jabatan';
		
        $nm_coloum= array('a.nik','a.nama','a.jenis_kelamin','b.nama_jabatan','b.email');
        $orderby= array('a.nik' => 'desc');
        $where=  array();
        $list = $this->m_karyawan->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'nik' => $datalist->nik,
            'nama' => $datalist->nama,
            'jenis_kelamin' =>$datalist->jenis_kelamin,
			'kategori' =>$datalist->kategori,
			'level' =>$datalist->level,
			'picture' =>$datalist->picture,
			'email' =>$datalist->email,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_karyawan('."'".$datalist->nik."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_karyawan('."'".$datalist->nik."'".')"><i class="fa fa-trash red"></i></a></div>'
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_karyawan->count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->m_karyawan->count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}

public function ajax_edit()
	{
	   	$nik     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_karyawan->get_by_id($nik,$nmtabel,$key);
		echo json_encode($data);
	}


	public function ajax_add()
	{   
	$username = $this->input->post('nik');
	$folder='./asset/images/karyawan/';
		$tmp  = $_FILES['gambar']['tmp_name'];
		$gbr=$_FILES['gambar']['name'];
	    $nmtabel='karyawan';
		$cek=$this->my_model->getdata('karyawan',"WHERE nik='$username'");
		 if($cek){
			$message='Username sudah ada di database, Coba dengan username lain !';
			$label='warning';
			$icon='times';
		 } else {
			 $message='Data berhasil disimpan !';
			$label='success';
			$icon='check'; 
		    $data = array(
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jk'),
				'id_jabatan' => $this->input->post('jabatan'),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'picture' => $gbr,
				'password' => sha1($this->input->post('password')),
			);
		     $simpan = $this->my_model->insert($nmtabel,$data);
		     move_uploaded_file($tmp,$folder.$gbr);
		 }
		  $msg=array(
		  'crumb'=>'karyawan',
		  'title'=>'karyawan',
		  'message'=>$message,
		  'label'=>$label,'icon'=>$icon,
		  'view'=>'admin/v_karyawan'
		  );
		$this->load->view('admin/home/home',$msg);
	}
	public function ajax_update()
	{	$folder='./asset/images/karyawan/';
		$tmp  = $_FILES['gambar']['tmp_name'];
		$oldpic=$this->input->post('oldpic');
		$gbr=$_FILES['gambar']['name'];
		if(!empty($gbr)){
		$image=$gbr;
		move_uploaded_file($tmp,$folder.$gbr);
		unlink('./asset/images/karyawan/'.$oldpic);
	} else {
		$image=$oldpic;
	}
	    $nmtabel='karyawan';
        $key='nik';
		$data = array(
				'nik' => $this->input->post('nik2'),
				'nama' => $this->input->post('nama2'),
				'jenis_kelamin' => $this->input->post('jk2'),
				'id_jabatan' => $this->input->post('jabatan2'),
				'email' => $this->input->post('email2'),
				'level' => $this->input->post('level2'),
				'picture' => $image,
				'password' => sha1($this->input->post('password2')),
			);
		$this->m_karyawan->update(array($key => $this->input->post('id_user')), $data,$nmtabel);
		redirect('karyawan');
	}


	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_karyawan->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
  function getJabatan(){
	  	
      $result=$cek=$this->my_model->getdata('jabatan',"order by id_jabatan");
	  echo'<option value="">Pilih Jabatan</option>';
	if($result)
	{
	foreach($result as $data){
	echo'<option value="'.$data->id_jabatan.'">'.$data->nama_jabatan.'</option>';
		
		}	
	}  
}
	
	
	
}
