<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class Profil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','akses','session','pagination'));
		$this->akses->auth();
	}
	function index()
	{
		$data['_title']   = "Profil User";
		$data['judul']    = "Profil User";
		
		$data['profil']   = $this->dbm->get_data_where('user',array('id_user'=>$this->session->userdata('id_user')))->row();

		$this->template->display('pengaturan/profil/index',$data);
	}
	function update()
	{
		if(!empty($_POST['password']))
		{

			$this->form_validation->set_rules('username','Username','trim|required|min_lenght[5]');
			$this->form_validation->set_rules('password','Password','trim|min_length[5]');
			$this->form_validation->set_rules('k_password','Konfirm Password','required|min_length[5]|matches[password]');
			if($this->form_validation->run())
			{

				$cek = $this->dbm->get_data_where('user',array('username'=>$_POST['username'],'id_user !='=>$_POST['id_user']))->row('username');
				if(!empty($cek))
				{
					echo "Username sudah dipakai";
				}	
				else
				{
					
					$up = $this->dbm->update('user',array('id_user' =>$_POST['id_user']),array(
														  'username'=>$_POST['username'],
														  'password'=>md5($_POST['password'])	
						));

					if($up)
					{
						echo "Profil user telah diupdate";
					}
				}
			}
			else
			{
				echo strip_tags(validation_errors());
			}
		}
		else
		{
			$this->form_validation->set_rules('username','Username','trim|required|min_lenght[5]');
			if($this->form_validation->run())
			{
				$cek = $this->dbm->get_data_where('user',array('username'=>$_POST['username'],'id_user !='=>$_POST['id_user']))->row('username');
				if(!empty($cek))
				{
					echo "Username sudah dipakai";
				}	
				else
				{
					$up = $this->dbm->update('user',array('id_user' =>$_POST['id_user']),array(
														  'username'=>$_POST['username'],
						));

					if($up)
					{
						echo "Profil user telah diupdate tanpa penggantian password";
					}
				}
			}
			else
			{
				echo strip_tags(validation_errors());
			}		
		}
		
	}
}