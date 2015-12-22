<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','session','akses'));
		$this->load->model('users_model');
		$this->akses->auth();				
	}
	function index()
	{	
		$data['_title'] = "Home";
		$data['user']   = $this->session->userdata('username');
		$data['level']	= $this->session->userdata('level'); 
		$this->template->display('home',$data);	
	}
}