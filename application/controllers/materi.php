<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
		$this->load->model('m_department');
		$this->load->model('my_model');
	}

    function index(){
       	  $data=array(
		  'title'=>' Data materi',
		  'title'=>'<i class="fa fa-clone"></i> Data Karyawan',
		  'view'=>'admin/v_materi'
		  );
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='materi a';
		$nm_tabel2='kategori b';
		$kolom1='a.id_kategori';
		$kolom2='b.id_kategori';
		
        $nm_coloum= array('a.id_materi','a.judul_materi','a.ket_materi','b.kategori');
        $orderby= array('a.id_materi' => 'desc');
        $where=  array();
        $list = $this->m_department->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'id_materi' => $datalist->id_materi,
            'judul_materi' => $datalist->judul_materi,
            'ket_materi' =>$datalist->ket_materi,
			'kategori' =>$datalist->kategori,
			'tgl_update' =>$datalist->tgl_update,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_data('."'".$datalist->id_materi."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$datalist->id_materi."'".')"><i class="fa fa-trash"></i></a></div>'
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
	   	$id_materi= $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_department->get_by_id($id_materi,$nmtabel,$key);
		echo json_encode($data);
	}
	public function ajax_add()
	{   
	$username = $this->input->post('nik');
	$folder='./asset/images/materi/';
		$tmp  = $_FILES['myfile']['tmp_name'];
		$myfile=$_FILES['myfile']['name'];
	    $nmtabel='materi';
		
			 $message='Data berhasil disimpan !';
			$label='success';
			$icon='check'; 
		    $data = array(
				'judul_materi' => $this->input->post('nama'),
				'id_kategori' => $this->input->post('kat'),
				'ket_materi' => $this->input->post('ket'),
				'file_path' => $myfile,
				'tgl_update' => date('Y-m-d'),
				'createby' => $this->session->userdata('nikuser'),
			);
		     $simpan = $this->my_model->insert($nmtabel,$data);
		     move_uploaded_file($tmp,$folder.$myfile);
		 
		  $msg=array(
		  'crumb'=>'materi',
		  'title'=>'materi',
		  'message'=>$message,
		  'label'=>$label,'icon'=>$icon,
		  'view'=>'admin/v_materi'
		  );
		$this->load->view('admin/home/home',$msg);
}
	public function ajax_update()
	{	$id=$this->input->post('idmateri');
		$folder='./asset/images/materi/';
		$tmp  = $_FILES['myfile']['tmp_name'];
		$oldpic=$this->input->post('oldpic');
		$myfile=$_FILES['myfile']['name'];
		if(!empty($myfile)){
		$image=$myfile;
		move_uploaded_file($tmp,$folder.$myfile);
		unlink('./asset/images/materi/'.$oldpic);
	} else {
		$image=$oldpic;
	}

		$data = array(
				'judul_materi' => $this->input->post('nama2'),
				'id_kategori' => $this->input->post('kat2'),
				'ket_materi' => $this->input->post('ket2'),
				'file_path' => $image,
				'tgl_update' => date('Y-m-d'),
				'createby' => $this->session->userdata('nikuser'),
			);
		$this->my_model->update("materi","id_materi",$id,$data);
		redirect('materi');
	}



	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_department->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
	
  function getkategori(){
	  	
      $result=$cek=$this->my_model->getdata('kategori',"order by id_kategori");
	  echo'<option value="">Pilih kategori</option>';
	if($result)
	{
	foreach($result as $data){
	echo'<option value="'.$data->id_kategori.'">'.$data->kategori.'</option>';
		
		}	
	}  
}
	
	
	
}
