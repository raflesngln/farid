<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
			$this->load->helper(array('form', 'url'));
		    $this->load->model('m_department');
			$this->load->model('my_model');
	}

    function index(){
       	  $data=array(
		  'title'=>' Data admin_user',
		  'title'=>'<i class="fa fa-user"></i> admin_user',
		  'view'=>'admin/v_admin_user'
		  );
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='user a';
		$nm_tabel2='jabatan b';
		$kolom1='a.jabatan';
		$kolom2='b.id_jabatan';
		
        $nm_coloum= array('a.id_user','a.fullname','a.username','b.nama_jabatan');
        $orderby= array('a.id_user' => 'desc');
        $where=  array();
        $list = $this->m_department->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'id_user' => $datalist->id_user,
            'fullname' => $datalist->fullname,
            'username' =>$datalist->username,
			'nama_jabatan' =>$datalist->nama_jabatan,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_data('."'".$datalist->id_user."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$datalist->id_user."'".')"><i class="fa fa-trash"></i></a></div>'
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_department->count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->m_department->count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}

public function ajax_edit()
	{
	   	$id_user= $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_department->get_by_id($id_user,$nmtabel,$key);
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
				'username' => $username,
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
	    $nmtabel='user';
        $key='id_user';
		$data = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'jabatan' => $this->input->post('jabatan'),
				'images' => $image,
				'password' => sha1($this->input->post('password')),
			);
		$this->m_department->update(array($key => $this->input->post('id_user')), $data,$nmtabel);
		redirect('admin_user');
	}

	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_department->delete_by_id($id,$nmtabel,$key);
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
