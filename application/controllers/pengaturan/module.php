<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class Module extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','pagination','akses','session'));
		$this->load->model('model_paging');
		$this->akses->auth();
	}
	function index()
	{
		$data['_title']   ="Module";
		$data['judul']    ="List Module";

						   $this->db->where("module.parent ='' || module.parent = 0 ");	
		$data['data_list']=$this->dbm->get_all_data('module')->result();
		
		$this->template->display('pengaturan/module/index',$data);
	}
	function get_child($parent = null)
	{
		$child = $this->dbm->get_data_where('module',array('parent'=>$parent))->result();

		return $child;
	}
	function tambah()
	{
		$data['_title'] 		="Tambah Module Baru";
		$data['judul']  		="Tambah Module Baru";
		$data['dropdown_parent']=$this->dbm->dropdown('module','-top parent-','id_module','nama_module');
			
		$this->template->display('pengaturan/module/form',$data);
	}
	function simpan()
	{
		$this->form_validation->set_rules('nama_module','Nama Module','required');
		
		
		if($this->form_validation->run())
		{
			$insert=$this->dbm->insert('module',array(
				                             'nama_module'=>$this->input->post('nama_module'),
				                             'icon_module'=>$this->input->post('icon_module'),
				                             'url_module' =>$this->input->post('url_module'),
				                             'parent'     =>$this->input->post('parent'),
				                             'order'      =>$this->input->post('order')
				                             ));
			if($insert==TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata('sukses','Data Module Tersimpan');
				echo 'ok';	
			}
		}
		else
		{
			echo strip_tags(validation_errors());
		}
	}
	function hapus($id_module)
	{
		die('p');
		$del=$this->dbm->delete('module',array('id_module'=>$id_module));
		if($del==TRUE)
		{
			die();
		}
	}
	function edit($id_module)
	{
		$data['_title'] 		="Edit Module";
		$data['judul']  		="Edit Module";
		$data['dropdown_parent']=$this->dbm->dropdown('module','-top parent-','id_module','nama_module');
		$data['edit_list']      =$this->dbm->get_data_where('module',array('id_module'=>$id_module))->row();
		
		$this->template->display('pengaturan/module/edit_form',$data);	
	}
	function update($id_module)
	{
		$this->form_validation->set_rules('nama_module','Nama Module','required');

		if($this->form_validation->run())
		{
			$update=$this->dbm->update('module',array('id_module'=>$id_module),array(
										'nama_module'=>$this->input->post('nama_module'),
				                        'icon_module'=>$this->input->post('icon_module'),
				                        'url_module' =>$this->input->post('url_module'),
				                        'parent'     =>$this->input->post('parent'),
				                        'order'      =>$this->input->post('order')
									  ));
			if($update==TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata('sukses','Data Module Terupdate');
				redirect(base_url()."pengaturan/module");	
			}
		}
		else
		{
			echo strip_tags(validation_errors());
		}
	}
	function tambah_mutiple()
	{
		$this->form_validation->set_rules('banyak_data','Kolom Banyak Data','required');
		if($this->form_validation->run())
		{
			if($_POST==NULL)
			{
				redirect('Module');
			}
			else
			{
				redirect('pengaturan/module/simpan_mutiple/'.$_POST['banyak_data']);
			}	
		}
		else
		{
			$this->index();
		}
		
	}
	function simpan_mutiple($banyak_data=0)
	{	
		if($_POST==NULL)
		{
			$data['_title'] 		="Tambah Module Baru (multiple)";
			$data['judul']  		="Tambah Module Baru (multiple)";

			$data['banyak_data']=$banyak_data;

			$data['dropdown_parent']=$this->dbm->dropdown('module','-top parent-','id_module','nama_module');
			$data['dropdown_icon']  =$this->dbm->dropdown('icon','-Pilih icon-','nama_icon','nama_icon');
			
			$this->template->display('pengaturan/module/mutiple_form',$data);
		
		}
		else
		{
			 $n=count($_POST['nama_module']);
			 $i=1;
			 
			 if(!empty($_POST['nama_module'][$i]))
			 {
			 	 for($i=1;$i<=$n;$i++)
				 {
				 	$this->dbm->insert('module',array(
				 			'nama_module'=>$_POST['nama_module'][$i],
				 			'icon_module'=>$_POST['icon_module'][$i],
				 			'url_module' =>$_POST['url_module'][$i],
				 			'parent'     =>$_POST['parent'][$i],
				 			'order'      =>$_POST['order'][$i]

				 		));
				 }

				 echo "<script type='text/javascript'>alert('Data Tersimpan')</script>";

				 $this->index();
			 }
			 else
			 {
			 	$this->session->set_flashdata('error','Perhatian : Kolom nama module tidak boleh kosong.');
			 	redirect('pengaturan/module/simpan_mutiple/'.$_POST['banyak_data']);
			 }
			 
		}	
	
	}

}