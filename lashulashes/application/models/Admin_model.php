<?php 
 Class Admin_model extends CI_Model{
 	
	public function __construct()
	{
		parent::__construct();
	}
	

			
//*************** Function for Update Data**************************//	
	function update_data($table,$data,$where)
	 {
			$this->db->where($where);
			$this->db->update($table,$data);
	 }

//***********************End Update Data******************************//	
	
	function insert_data($table,$data)						//inserting data into DB
	{
	    $sql = $this->db->insert_string($table,$data);
	    $this->db->query($sql);
	    $last_id = $this->db->insert_id();	
		return $last_id;
	}


		public function delete_record($table_name='', $id_array=''){
		
		return $this->db->delete($table_name, $id_array);
	}

	public function getColumnDataWhere($table,$column='',$where='',$orderby='',$ordertype='')
	{
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table);
		if($where !='')
		{
			$this->db->where($where);
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'ASC');
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	
	function getDataColumnWherePagination($table,$column='',$startlimit,$records,$where='',$orderby='')
	 {
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table);
		if($where !='')
		{
			$this->db->where($where);
		}
		$this->db->limit($records,$startlimit);
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
		}
		$query=$this->db->get();
		return $query->result();
	 }


	 function getDataColumnWherePaginationCount($table,$column='',$where='')//fatch all data with where and limit condition
	 {
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table);
		if($where !='')
		{
			$this->db->where($where);
		}
		$query=$this->db->get();
		return $query->num_rows();
	 }

	  /*++++++++++++++++ Query For Two table pagination  +++++++++++++++++++++++++*/	
	function getDataTwoTableColumnWherePagination($table1,$table2,$id1,$id2,$column='',$startlimit,$records,$where='',$orderby='')
	 {
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table1);
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);
		if($where !='')
		{
			$this->db->where($where);
		}
		$this->db->limit($records,$startlimit);
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
		}
		$query=$this->db->get();
		return $query->result();
	 }
	
	function getDataTwoTableColumnWherePaginationCount($table1,$table2,$id1,$id2,$column='',$where='')//fatch all data with where and limit condition
	 {
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table1);
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);		
		if($where !='')
		{
			$this->db->where($where);
		}
		$query=$this->db->get();
		return $query->num_rows();
	 }
	 
	
	
	
 }
?>
