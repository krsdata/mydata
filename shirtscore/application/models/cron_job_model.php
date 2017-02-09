<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	public function get_users_for_pay(){

		 	$this->db->select('rqst.unpaid_com,rqst.total_paid_com,us_pay.paypal_email,us_pay.user_id');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.unpaid_com >= ', 100);
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.is_paypal', 1);
			$this->db->or_where_in('us_pay.user_id', $user_ids);
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = rqst.user_id');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}



	public function get_email_stock_low() {		
		$this->db->select('u.id, p.name, s.store_name, u.firstname, u.lastname, u.email, p_v.size, p_v.in_stock,p_v.sales_from_stock');
    	
    	$this->db->select_sum("o.quantity", 'sold');    	
		
		$this->db->from('products as p');		
		
		$this->db->join('product_variations as p_v', 'p_v.product_id = p.id');		
		$this->db->join('order_items as o', 'o.size_id = p_v.id');
		$this->db->join('stores as s', 's.id = p.store_id');
		$this->db->join('users as u', 's.user_id = u.id');
		
		$this->db->group_by('p_v.id');
		
		$this->db->where('o.is_cancelled' , 0);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return FALSE;
	}
}