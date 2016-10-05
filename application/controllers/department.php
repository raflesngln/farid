<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
		$this->load->model('m_department');
	}

    function index(){
       	  $data=array(
		  'title'=>' Data department',
		  'title'=>'<i class="fa fa-pie-chart"></i> Data Karyawan',
		  'view'=>'admin/v_department'
		  );
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='kategori a';
		$nm_tabel2='user b';
		$kolom1='a.createby';
		$kolom2='b.id_user';
		
        $nm_coloum= array('a.id_kategori','a.kategori','a.deskripsi');
        $orderby= array('a.id_kategori' => 'desc');
        $where=  array();
        $list = $this->m_department->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'id_kategori' => $datalist->id_kategori,
            'kategori' => $datalist->kategori,
            'deskripsi' =>$datalist->deskripsi,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_data('."'".$datalist->id_kategori."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$datalist->id_kategori."'".')"><i class="fa fa-trash"></i></a></div>'
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
	   	$id_kategori= $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_department->get_by_id($id_kategori,$nmtabel,$key);
		echo json_encode($data);
	}

	public function ajax_add()
	{   
	    $nmtabel='kategori';
		$data = array(
				'kategori' => $this->input->post('kategori'),
				'deskripsi' => $this->input->post('deskripsi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$insert = $this->m_department->save($data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
	    $nmtabel='kategori';
        $key='id_kategori';
		$data = array(
				'kategori' => $this->input->post('kategori'),
				'deskripsi' => $this->input->post('deskripsi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$this->m_department->update(array($key => $this->input->post('id_kategori')), $data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_department->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
}
