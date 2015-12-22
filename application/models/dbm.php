<?php

class Dbm extends CI_Model
{

/* CREATE */
	function insert($table,$data)
	{
		$in = $this->db->insert($table,$data);
		if($in === TRUE) return TRUE;
		else return FALSE;
	}


/* READ */
	function sum_data($field,$table)
	{
		return $this->db->select_sum($field)->get($table);
	}

	function sum_data_where($field,$table,$where)
	{
		return $this->db ->select($field)
						 ->where($where)
						 ->select_sum($field)
						 ->get($table);
	}

	function max_data($field,$table,$where=null)
	{
		if($where != null) {
			$this->db->where($where);
		}

		return $this->db->select_max($field)->get($table);
	}

	function get_all_data($table,$limit=NULL,$order_by=NULL,$order_sort=NULL)
	{
		if (($order_by && $order_sort) != NULL) {
			$this->db->order_by($order_by,$order_sort);
		}

		$get = $this->db->get($table,$limit);

		return $get;
	}

	function get_data_where($table,$where,$order_by=NULL,$order_sort=NULL,$limit=NULL)
	{
		if (($order_by && $order_sort) != NULL) {
			$this->db->order_by($order_by,$order_sort);
		}
		
		$get = $this->db ->where($where)
						 ->get($table,$limit);
		return $get;
	}

	function get_one_data($table,$field,$where)
	{
		$get = $this->db ->select($field)
						 ->where($where)
						 ->get($table,1)
						 ->row();
		foreach ($get as $key) {
			return $key;
		}
	}

	function select_distinct($field, $table, $order_by=NULL, $order_sort=NULL)
	{	if (($order_by && $order_sort) != NULL) {
			$this->db->order_by($order_by,$order_sort);
		}

		$get = $this->db->select($field)->distinct()->get($table);
		return $get;
	}

	// select,where,join 1 table
	function get_data_where_join_1($table,$where,$join,$join_on)
	{
		$this->db->join($join,$join_on);
		return $this->get_data_where($table,$where);
	}
	
	// select,where,join 2 table
	function get_data_where_join_2($table,$where,$join1,$join_on1,$join2,$join_on2)
	{
		$this->db	->join($join1,$join_on1)
					->join($join2,$join_on2);
		return $this->get_data_where($table,$where);
	}

	function get_array($table, $field, $where = NULL)
	{	
		if($where != NULL)
			$this->db->where($where);

		$get 	= $this->db->select($field)->get($table)->result();

		$array 	= array();

		foreach ($get as $key) 
		{
			$array[] = $key->$field;
		}

		return $array;
	}

/* UPDATE */
	function update($table,$where,$data)
	{
		$update = $this->db->where($where)->update($table,$data);
		if($update === TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

/* DELETE */
	function delete($table,$where)
	{
		$del = $this->db->where($where)->delete($table);

		if($del === TRUE) return TRUE;
		else return FALSE;
	}

	function delete_all($table)
	{
		$this->db->empty_table($table);
	}

/* OTHERS */
	function dropdown($table, $txt=NULL, $value, $name, $where=NULL, $separator=NULL, $order_by=NULL, $order_sort='ASC')
	{	//print_r($where);die();
		if($order_by != NULL)
			$this->db->order_by($order_by, $order_sort);

		if($where != NULL)
			$this->db->where($where);

		$get = $this->get_all_data($table)->result();

		$dropdown = $txt != NULL ? is_array($txt) ? $txt : array("" => $txt) : array();
		$nama = "";

		foreach($get as $key)
		{
			if(is_array($name))
			{
				foreach($name as $val)
				{
					$nama .= $key->$val.$separator;
				}
				$nama = rtrim($nama, $separator);
			}
			else
			{
				$nama = $key->$name;
			}

			$dropdown[$key->$value] = $nama;
			$nama = "";
		}
		return $dropdown;
	}
  
  function highest_id_plus_one($field,$table)
  {
    $get_max = $this->max_data($field,$table);
    
    return ($get_max->num_rows() == "0") ? "1" : $get_max->row()->$field+1;
  }

  function open_data_list($field,$typed,$table)
  {
    $get = $this->db  ->like($field, $typed, 'both')
                      ->get($table, 50);
    return $get->result();
  }

}
