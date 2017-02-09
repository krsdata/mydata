<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_model extends CI_Model {	
	
	public function export_orders($from_date='', $to_date='', $type=''){	
		if(strtolower($type)=='storeadmin'){
		$info = $this->session->userdata('storeadmin_info');
		$admin_id = $info['id'];
		 $store_arr = get_store_id($admin_id);
		}
		$this->db->order_by('o.id', 'desc');		
		$this->db->select('o.*,oi.order_id as order_item_id ');		
		if(strtolower($type)=='storeadmin'){
		$stores_id=array();
			foreach ($store_arr as $row) {
				$stores_id[]=$row->id;
			}
		if(is_array($stores_id))
			$this->db->where_in('oi.store_id', $stores_id);		
		}
		$this->db->from('orders as o');
		$this->db->where("o.created BETWEEN '$from_date' AND '$to_date'");
		$this->db->join('order_items as oi', 'oi.order_id = o.id');
		$this->db->group_by('o.id');		
		$query=$this->db->get();					
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function export_commssion_pdf($type){	
		
		$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email,us_pay.acc_holder,us_pay.acc_type,us_pay.acc_holder,us_pay.bank_name,us_pay.acc_no,us_pay.routing_no,us_pay.full_name,us_pay.address');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.payee_type', $type);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');

		$query=$this->db->get();					
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

}/*end of file*/