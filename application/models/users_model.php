<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Users_model extends CI_Model
		{
			public $table		="user";
			public $primary_key	="id_user";

			function __construct()
				{
					parent::__construct();	
				}
			function get_login_info($username)
				{
					$this->db->where('username',$username);
					$this->db->limit(1);
					$this->db->join('user_level','user.id_level=user_level.id_level');
					$query=$this->db->get($this->table);
					return($query->num_rows() > 0)? $query->row() : FALSE;
				}
			function cek_hak_akses($id_level,$id_module)
				{
					$this->db 	->select('*')
								->where('id_level',$id_level)
								->where('id_module',$id_module);
					$result = $this->db->get('user_akses',1);
					if($result->num_rows() == 0)
					{
						return FALSE;
					}
					return TRUE;
				}
		}