<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','form','captcha'));
		$this->load->model(array('dbm','users_model'));
		$this->load->library(array('session','akses','form_validation'));
	}
	function index()
	{
		$data['_title']="Login";
		$this->load->view('form_login',$data);
	}
	function user_login()
	{
		$this->form_validation->set_rules('username','Username','trim|required|strip_tags');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('token','token','callback_cek_login');
					
			if($this->form_validation->run()==FALSE)
			{
				echo "<script type='text/javascript'>alert('Username & Password anda salah!')</script>";
				$this->index();
			}
			else
			{
				redirect(base_url()."home");
					
			}
	}
	function cek_login()
	{

		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',FALSE);	
		$login    = $this->akses->login($username,$password);

			if($login)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	function logout()
	{
		$this->akses->logout();
		redirect(base_url()."login");
					
	}
}