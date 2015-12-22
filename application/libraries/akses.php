<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Akses 
		{
			public $user;

			function __construct()
				{
					$this->CI= & get_instance();
					$auth	 = $this->CI->config->item('auth');

					$this->CI->load->helper("cookie");
					$this->CI->load->model("users_model");

					$this->users_model= $this->CI->users_model;
				}
			function login ($username,$password)
				{
					$result=$this->users_model->get_login_info($username);
					if($result)
						{
							$password=md5($password);
							if(($password === $result->password))
								{
									$this->CI->session->set_userdata('id_user',$result->id_user);
									$this->CI->session->set_userdata('username',$result->username);
									$this->CI->session->set_userdata('id_level',$result->id_level);
									$this->CI->session->set_userdata('level',$result->level);
									return TRUE;
								}
						}

					return FALSE;
				}
			function is_login()
				{
					return(($this->CI->session->userdata('id_user')) ? TRUE:FALSE);
				}
			function auth()
			{
				if(!$this->is_login())
				{
					redirect(base_url()."login");
					exit(0);
				}	
			}
			function logout()
				{
					$this->CI->session->unset_userdata('id_user');
				}
		}