<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_service_model extends CI_Model {	

	public function insert($table_name='',  $data=''){
		$query=$this->db->insert($table_name, $data);
		if($query)
			return  $this->db->insert_id();
		else
			return FALSE;		
	}

	public function get_result($table_name='', $id_array='', $sort='',$limit=''){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		if(!empty($sort)):		
			foreach ($sort as $key => $value){
				$this->db->order_by($key, $value); //$key = 'feild to be sort', $value = Order of arrangement (asc or desc)
			}
		endif;

		if(!empty($limit)):		
			foreach ($limit as $key => $value){
				$this->db->limit($key, $value); //$key = 'No. of records to be fetched', $value = offset to begin
			}
		endif;

		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function get_row($table_name='', $id_array='', $sort='',$limit=''){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		if(!empty($sort)):		
			foreach ($sort as $key => $value){
				$this->db->order_by($key, $value); //$key = 'feild to be sort', $value = Order of arrangement (asc or desc)
			}
		endif;

		if(!empty($limit)):		
			foreach ($limit as $key => $value){
				$this->db->limit($key, $value); //$key = 'No. of records to be fetched', $value = offset to begin
			}
		endif;
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
}
	public function update($table_name='', $data='', $id_array=''){
		foreach ($id_array as $key => $value){
			$this->db->where($key, $value);
		}		
		return $this->db->update($table_name, $data);
	}

	public function delete($table_name='', $id_array=''){		
		return $this->db->delete($table_name, $id_array);
	}

	public function tagged_queries($limit, $offset){
		$cs_info = customer_services_info();
		// print_r();
		// die();	
		$this->db->select('sup.*');
		$this->db->from('supports as sup');
		$this->db->where('tag_status', 1);
		$this->db->where('cust_service_id', $cs_info['id']);
		$this->db->join('support_tags as suptag', 'suptag.support_id = sup.id');
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('id', 'desc');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('id', 'desc');						
			$query=$this->db->get();
			return $query->num_rows();
		}
	}

	public function get_tagged_support($support_id=''){

		$this->db->select('csc.*');
		$this->db->from('supports as sup');
		$this->db->where('tag_status', 1);
		$this->db->join('cs_conversation as csc', 'csc.support_id = sup.id');
		$this->db->order_by('id', 'desc');
		$query=$this->db->get('supports');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	/*
	* 
	*
	*/

}/* End of file customer_service_model.php */
