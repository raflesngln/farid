<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
		$this->load->model('m_jabatan');
		$this->load->model('my_model');
	}

    function index(){
       	  $data=array(
		  'title'=>' Data Jabatan',
		  'title'=>'<i class="fa fa-star"></i> Data Karyawan',
		  'view'=>'admin/v_jabatan'
		  );
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='jabatan a';
		$nm_tabel2='kategori b';
		$kolom1='a.id_kategori';
		$kolom2='b.id_kategori';
		
        $nm_coloum= array('a.id_jabatan','a.nama_jabatan','a.deskripsi');
        $orderby= array('a.id_jabatan' => 'desc');
        $where=  array();
        $list = $this->m_jabatan->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'id_jabatan' => $datalist->id_jabatan,
			'kategori' => $datalist->kategori,
            'nama_jabatan' => $datalist->nama_jabatan,
            'deskripsi' =>$datalist->deskripsi,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_data('."'".$datalist->id_jabatan."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$datalist->id_jabatan."'".')"><i class="fa fa-trash"></i></a></div>'
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_jabatan->count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->m_jabatan->count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}

public function ajax_edit()
	{
	   	$id_jabatan= $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_jabatan->get_by_id($id_jabatan,$nmtabel,$key);
		echo json_encode($data);
	}

	public function ajax_add()
	{   
	    $nmtabel='jabatan';
		$data = array(
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'id_kategori' => $this->input->post('devisi'),
				'deskripsi' => $this->input->post('deskripsi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$insert = $this->m_jabatan->save($data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
	    $nmtabel='jabatan';
        $key='id_jabatan';
		$data = array(
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'id_kategori' => $this->input->post('devisi'),
				'deskripsi' => $this->input->post('deskripsi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$this->m_jabatan->update(array($key => $this->input->post('id_jabatan')), $data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_jabatan->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
  function getDevisi(){
      $result=$cek=$this->my_model->getdata('kategori',"order by id_kategori");
	echo'<option value="">Pilih Devisi</option>';
	if($result)
	{
	foreach($result as $data){
	echo'<option value="'.$data->id_kategori.'">'.$data->kategori.'</option>';
		
		}	
	}  
}	

	
	
}
