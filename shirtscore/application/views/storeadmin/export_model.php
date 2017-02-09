<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_model extends CI_Model {	



	public function statistic_diff_date_data($from_date='', $to_date=''){	

		$info = $this->session->userdata('storeadmin_info');
		$admin_id = $info['id'];

		 $store_arr = get_store_id($admin_id);
		$this->db->order_by('o.id', 'desc');
		if($search !=""){
			$this->db->like('o.order_id', $search);
		}
		$this->db->select('o.*,oi.order_id as order_item_id ');
		//$this->db->where('oi.store_id', $store_arr[0]->id);
		$stores_id=array();
		foreach ($store_arr as $row) {
			$stores_id[]=$row->id;
		}
		if(is_array($stores_id))
			$this->db->where_in('oi.store_id', $stores_id);

		// $this->db->where('o.order_status !=',5);
		$this->db->from('orders as o');
		$this->db->where("o.created BETWEEN '$from_date' AND '$to_date'");
		$this->db->join('order_items as oi', 'oi.order_id = o.id');
		$this->db->group_by('o.id');
		
		
		$query=$this->db->get();
		// print_r($query->result()); die();			
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	


	}


}/*end of file*/