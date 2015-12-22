<?php
	class Template
	{
		protected $_ci;
		
		function __construct()
		{
			$this->_ci=&get_instance();

		}
		function tampilan_menu()
		{
			$this->_ci->db	->select('*')
							->join('user_akses','user_akses.id_module = module.id_module')
							->order_by('module.order','ASC')
							->where('user_akses.id_level',$this->_ci->session->userdata('id_level'))
							->where('module.parent =',0);
			$result = $this->_ci->db->get('module')->result();
			return $result;
		}
		
		function sub_menu($parent)
		{
			$this->_ci->db	->select('*')
							->join('user_akses','user_akses.id_module = module.id_module')
							->order_by('module.order','ASC')
							->where('user_akses.id_level',$this->_ci->session->userdata('id_level'))
							->where('parent',$parent);
			$result = $this->_ci->db->get('module');
			
			if($result->num_rows() > 0)
			{
				return $result->result();
			}
			else
			{
				return FALSE;
			}
		}
		function display($template,$data=NULL)
		{
			if(!$this->is_ajax())
			{
				$data['_content'] 	=$this->_ci->load->view($template,$data,TRUE);
				$data['_header']  	=$this->_ci->load->view('template/header',$data,TRUE);
				$data['_menu']  	=$this->tampilan_menu();
				$data['_footer']    =$this->_ci->load->view('template/footer',$data,TRUE);
						
				$this->_ci->load->view('template.php',$data);
			}
			else
			{
				$this->_ci->load->view($template,$data);
			}
		}
		function is_ajax()		
		{
			return
			($this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&($this->_ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
		}
		
	}