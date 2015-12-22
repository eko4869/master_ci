<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class User_level extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','session','akses'));
		$this->load->model('dbm');
		$this->akses->auth();
	}
	function index()
	{
		$data['_title']     = "User Level";
		$data['judul']      = "List User Level";
		$data['data_list']  = $this->dbm->get_all_data('user_level')->result();
		$this->template->display('pengaturan/user_level/index',$data);
	}
	function tambah()
	{
		$data['_title'] 		="Tambah Level Baru";
		$data['judul']  		="Tambah Level Baru";
			
		$this->template->display('pengaturan/user_level/form',$data);
	}
	function simpan()
	{
		$this->form_validation->set_rules('level','Level','required');
		
		if($this->form_validation->run())
		{
			$insert=$this->dbm->insert('user_level',array(
				                             'level'      =>$this->input->post('level')
				                             ));
			if($insert==TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata('sukses','Data Tersimpan');
				echo "ok";
			}
		}
		else
		{
			echo strip_tags(validation_errors());
		}
	}
	function hapus($id_level)
	{
		$del=$this->dbm->delete('user_level',array('id_level'=>$id_level));
		if($del==TRUE)
		{
			die();
		}
	}
	function edit($id_level)
	{
		$data['_title'] 		="Edit Level";
		$data['judul']  		="Edit Level";
		$data['edit_list']      =$this->dbm->get_data_where('user_level',array('id_level'=>$id_level))->row();
			
		$this->template->display('pengaturan/user_level/edit_form',$data);	
	}
	function update($id_level)
	{
		$this->form_validation->set_rules('level','Level','required');

		if($this->form_validation->run())
		{
			$update=$this->dbm->update('user_level',array('id_level'=>$id_level),array(
										'level'=>$this->input->post('level')
				                        
									  ));
			if($update==TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata('sukses','Data terupdate');
				echo "ok";
			}
		}
		else
		{
			echo strip_tags(validation_errors());
		}
	}
	function hak_akses($id_level)
	{
		$data['_title'] 		="Setting Hak Akses";
		$data['judul']  		="Setting Hak Akses";

		$data['level']          =$this->dbm->get_data_where('user_level',array('id_level'=>$id_level))->row();
		$data['list_module']    =$this->dbm->get_all_data('module',NULL,'id_module','ASC')->result();
		$this->template->display('pengaturan/user_level/setting_hak_akses',$data);
			
	}

	function aktifkan()
	{
		$id_level =$this->uri->segment(4);
		$id_module=$this->uri->segment(5);

		if(!empty($id_level) && !empty($id_module))
		{
			$this->dbm->insert('user_akses',array(
				'id_level' =>$id_level,
				'id_module'=>$id_module
				));
		}
		redirect(base_url()."pengaturan/user_level/hak_akses/".$id_level);
	}
	function nonaktifkan()
	{
		$id_level =$this->uri->segment(4);
		$id_module=$this->uri->segment(5);

		if(!empty($id_level) && !empty($id_module))
		{
			$this->dbm->delete('user_akses',array(
				'id_level' =>$id_level,
				'id_module'=>$id_module
				));
		}
		redirect(base_url()."pengaturan/user_level/hak_akses/".$id_level);
	}
	
}