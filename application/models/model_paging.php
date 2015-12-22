<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class Model_paging extends CI_Model

{
	function __construct()
	{
		parent::__construct();
	}
	function paging_general($table,$per_page,$limit)
	{
		$query=$this->db->get($table,$per_page,$limit);

		return $query;
	}
	function get_total_rows($table)
	{
		return $this->db->count_all_results($table);
	}
}