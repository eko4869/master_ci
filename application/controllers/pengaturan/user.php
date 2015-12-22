<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','akses','session','pagination'));
		$this->akses->auth();
	}
	function index()
	{
		$data['_title']   = "User";
		$data['judul']    = "List User";
							if($this->session->userdata('level') != 'PSadmin')
							{
								$this->db->where('id_level !=','1');
							}
							
		$data['data_list']= $this->db->get('user',10,0)->result();
		$data['paging']   = $this->generatePagination();
		$this->template->display('pengaturan/user/index',$data);
	}
	function page()
	{
		$data['_title']   = "User";
		$data['judul']    = "List User";
		$page = $this->uri->segment(4); 
							if($this->session->userdata('level') != 'PSadmin')
							{
								$this->db->where('id_level !=','1');
							}
							
		$data['data_list']= $this->db->get('user',10,$page)->result();
		$data['paging']   = $this->generatePagination();
		$this->template->display('pengaturan/user/index',$data);
	}
	function generatePagination()
	{
		$this->load->model('model_paging');

	    $config['base_url']     = base_url() ."pengaturan/user/page";
	    $config['total_rows']   = $this->model_paging->get_total_rows('user');
	    $config['uri_segment']  = 4;
	    $config['per_page']     = 10;
	    $config['num_links']    = 2;
	     
	    $this->pagination->initialize($config);
	      
	    return $this->pagination->create_links();
	      
	}
	function tambah()
	{
		$data['_title'] 		="Tambah User Baru";
		$data['judul']  		="Tambah User Baru";

								 $this->db->where('id_level !=','1');
		$data['dropdown_level'] =$this->dbm->dropdown('user_level','-pilih level-','id_level','level');	
		

		$this->template->display('pengaturan/user/form',$data);
		
	}
	function simpan()
	{
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|is_unique[user.username]');
		$this->form_validation->set_rules('password','Password','required|min_length[5]');
		$this->form_validation->set_rules('konfirm_password','Konfirm Password','required|min_length[5]|matches[password]');
		$this->form_validation->set_rules('id_level','Level','required');


		if($this->form_validation->run())
		{
			$insert=$this->dbm->insert('user',array(
				                             'username'   =>$this->input->post('username'),
				                             'password'   =>md5($this->input->post('password')),
				                             'id_level'   =>$this->input->post('id_level')
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
	function hapus($id_user)
	{
		$del=$this->dbm->delete('user',array('id_user'=>$id_user));
		if($del==TRUE)
		{
			die();
		}
	}
	function edit($id_user)
	{
		$data['_title'] 		="Edit User Baru";
		$data['judul']  		="Edit User Baru";
		
								 $this->db->where('id_level !=','1');
		$data['dropdown_level'] =$this->dbm->dropdown('user_level','-pilih level-','id_level','level');	
		
		
		$data['edit_list']      =$this->dbm->get_data_where('user',array('id_user'=>$id_user))->row(); 
			
		$this->template->display('pengaturan/user/edit_form',$data);
	}
	function update($id_user)
	{
		if(!empty($_POST))
		{
			if(!empty($_POST['password']))
			{
				$this->form_validation->set_rules('username','Username','trim|required|min_lenght[5]');
				$this->form_validation->set_rules('password','Password','trim|min_length[5]');
				$this->form_validation->set_rules('konfirm_password','Konfirm Password','required|min_length[5]|matches[password]');
				$this->form_validation->set_rules('id_level','Level','required');
			}
			elseif(($_POST['username']) != ($_POST['hidden_username']))
			{
				$this->form_validation->set_rules('username','Username','trim|required|is_unique[user.username]|min_lenght[5]');
			}
			else
			{
				$this->form_validation->set_rules('username','Username','trim|required|min_lenght[5]');
				$this->form_validation->set_rules('id_level','Level','required');
			}
			
		}

		if ($this->form_validation->run()==TRUE)
		{
			
			$update=$this->dbm->update('user',array('id_user'=>$id_user),array(
						'username'         => $this->input->post('username'),
						'password'         => (!empty($_POST['password']) ? md5($this->input->post('password')) : $this->input->post('hidden_password')),
						'id_level'         => $this->input->post('id_level')
				));
			if($update==TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata('sukses','Data Terupdate');
				echo "ok";
			}
		}
		else
		{
			echo strip_tags(validation_errors());
		}
	}
}