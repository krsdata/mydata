<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {	

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

	/*
	* 
	*
	*/
	public function check_email($email){
		$query=$this->db->get_where('users',array('email'=>$email));
		if($query->num_rows()>0)
			return TRUE;
		else
			return FALSE;
	}
	

	public function get_user_details($email){
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			if($query->row()->banned==1){
					$msg['error_msg']='Account has banned.';			
					$msg['status']=FALSE;
					// echo "msg 1";
					// die();
					return $msg;
				}else if($query->row()->activated==0){
					$msg['error_msg']='Account not activated yet.';				
					$msg['status']=FALSE;
					// echo "msg 2";
					// die();
					return $msg;
				}else{
			$row=array(
						'id'=>$query->row()->id,
						'user_role'=>$query->row()->user_role,
						'username'=>$query->row()->username,
						'firstname'=>$query->row()->firstname,
						'lastname'=>$query->row()->lastname,
						'email'=>$query->row()->email,
						'last_ip'=>$query->row()->last_ip,
						'last_login'=>$query->row()->last_login,
						'logged_in'=>TRUE
						);

				if($query->row()->is_storeadmin == 1){
					$this->session->set_userdata('storeadmin_info', $row);
				}
				$this->session->set_userdata('customer_info',$row);

				$this->update_login_info($query->row()->id, $record_ip=TRUE, $record_time=TRUE);

					$msg['error_msg']='Okk.';
					$msg['is_storeadmin']=$query->row()->is_storeadmin;
					$msg['status']=TRUE;
					return $msg;
			}
		}
	}

	function update_login_info($user_id, $record_ip, $record_time) 
	{
		
		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);
		$this->db->update('users');
	}



	/*public function get_user_profile(){
		$user_id = customer_id();
		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->where('users.id', $user_id);	
		// $this->db->where('user_role',3);
		 $this->db->join('user_payee_info as user_p','user_p.user_id=users.id');

		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}*/

	public function get_user_profile(){
		$user_id = customer_id();
		$this->db->select('users.*, user_p.*');
		$this->db->from('users');
		$this->db->where('users.id', $user_id);	
		// $this->db->where('user_role',3);
		$this->db->join('user_payee_info as user_p','user_p.user_id=users.id');

		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	public function my_query($limit, $offset){	
		$uid = customer_id();		
		$this->db->where('customer_id', $uid);
		$this->db->order_by('id', 'desc');		
		if($limit>0 && $offset>=0){					
			$this->db->limit($limit, $offset);
			$query=$this->db->get('supports');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$query=$this->db->get('supports');
			return $query->num_rows();
		}
	}
	

	// Waseem's Done
	public function pending_designs($uid, $limit, $offset){

		$this->db->where('status', 0);			
		$this->db->where('artist_id', $uid);			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('id', 'desc');			
			$query=$this->db->get('design');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('id', 'desc');						
			$query=$this->db->get('design');
			return $query->num_rows();
		}
	}

	public function approved_designs($uid, $limit, $offset){

		$this->db->where('status', 1);			
		$this->db->where('artist_id', $uid);			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('id', 'desc');			
			$query=$this->db->get('design');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('id', 'desc');						
			$query=$this->db->get('design');
			return $query->num_rows();
		}
	}

	public function sales_report($uid ,$list_by ,$from_date ,$to_date ,$limit=0, $offset=0){
		// echo "<br> from_date :".$from_date;
		// echo "<br> to_date :".$to_date;
		// die();
		if(($from_date != '-') && !empty($from_date) && ($to_date != '-') && !empty($to_date)){
			$this->db->where("d_sales.created BETWEEN '$from_date' AND '$to_date'");
		}

		$this->db->where('d_sales.payment_status', $list_by);

		$this->db->select('od.order_id as od_id,d_sales.*');
		$this->db->from('orders as od');
		$this->db->where('dgn.artist_id', $uid);
		$this->db->join('design_sales as d_sales','od.id=d_sales.order_id');			
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('od.id', 'desc');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('od.id', 'desc');
			$query=$this->db->get();
			return $query->num_rows();
		}
	}

	public function orders($limit, $offset, $user_id=""){

		$this->db->select('od.*');
		$this->db->from('orders as od');
		$this->db->where('byr.user_id', $user_id);
		$this->db->join('buyers as byr','byr.id=od.buyer_id');
		$this->db->order_by('od.created','DESC');
		if($limit > 0 && $offset>=0)
		{
			$this->db->limit($limit, $offset);
			$query=$this->db->get();			
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	 	}
	 	else{		
			$query=$this->db->get();
			return $query->num_rows();
  		}
	}

	public function order_user_info($order_id){
		$this->db->select('orders.*, buyers.recipient_name, buyers.email, buyers.delivery_address, buyers.shipping_city2, buyers.shipping_state2, buyers.country, buyers.shipping_zip2 ');
		$this->db->from('orders');
		$this->db->join('buyers','buyers.id=orders.buyer_id');	
		$this->db->where('orders.id',$order_id);		
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	public function order_info($order_id){
		// echo "here"; die();
		$this->db->select('oi.*,p.name,o.total_amount,o.tax_amount,o.order_status');
		$this->db->from('order_items as oi');
		$this->db->join('orders as o','o.id=oi.order_id');
		$this->db->join('products as p','p.id=oi.product_id');	
		$this->db->where('oi.order_id',$order_id);
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function design_sales_orders($uid){
		$this->db->select_sum('d_sales.order_id');
		$this->db->from('design_sales as d_sales');
		$this->db->where('dgn.artist_id', $uid);
		// $this->db->where('d_sales.payment_status', 0);
		$this->db->group_by('d_sales.order_id');
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');

		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->num_rows();
		else
			return FALSE;
	}

	public function sales_history($uid){
		$this->db->select_sum('d_sales.total');
		$this->db->select_sum('d_sales.qty');
		$this->db->from('orders as od');
		$this->db->where('dgn.artist_id', $uid);
		// $this->db->where('d_sales.payment_status', 0);
		$this->db->join('design_sales as d_sales','od.id=d_sales.order_id');			
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	public function commission_info($uid){
		$this->db->select('unpaid_com, total_paid_com');
		$this->db->where('user_id', $uid);
		$query=$this->db->get('commission_request');
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	// Waseem's Done

	// public function my_query($uid,$limit,$offset){			
	// 	$this->db->limit($limit, $offset);
	// 	$this->db->where('customer_id', $uid);
	// 	$this->db->order_by('id', 'desc');		
	// 	if($limit > 0 && $offset>=0){					
	// 		$query=$this->db->get('supports');
	// 		if($query->num_rows()>0)
	// 			return $query->result();
	// 		else
	// 			return FALSE;
	// 	}else{
	// 		$query=$this->db->get('supports');
	// 		return $query->num_rows();
	// 	}
	// }
	
		/*public function sales_report($uid ,$list_by ,$from_date ,$to_date ,$limit=0, $offset=0){
		// echo "<br> from_date :".$from_date;
		// echo "<br> to_date :".$to_date;
		// die();
		if(($from_date != '-') && !empty($from_date) && ($to_date != '-') && !empty($to_date)){
			$this->db->where("d_sales.created BETWEEN '$from_date' AND '$to_date'");
		}

		$this->db->where('d_sales.payment_status', $list_by);

		$this->db->select('od.order_id as od_id,d_sales.*');
		$this->db->from('orders as od');
		$this->db->where('dgn.artist_id', $uid);
		$this->db->join('design_sales as d_sales','od.id=d_sales.order_id');			
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('od.id', 'desc');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('od.id', 'desc');
			$query=$this->db->get();
			return $query->num_rows();
		}
	}

	public function sales_history($uid){
		$this->db->select_sum('d_sales.total');
		$this->db->select_sum('d_sales.qty');
		$this->db->from('orders as od');
		$this->db->where('dgn.artist_id', $uid);
		// $this->db->where('d_sales.payment_status', 0);
		$this->db->join('design_sales as d_sales','od.id=d_sales.order_id');			
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	public function design_sales_orders($uid){
		$this->db->select_sum('d_sales.order_id');
		$this->db->from('design_sales as d_sales');
		$this->db->where('dgn.artist_id', $uid);
		// $this->db->where('d_sales.payment_status', 0);
		$this->db->group_by('d_sales.order_id');
		$this->db->join('design as dgn','dgn.id=d_sales.design_id');

		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->num_rows();
		else
			return FALSE;
	}

	public function commission_info($uid){
		$this->db->select('unpaid_com, total_paid_com');
		$this->db->where('user_id', $uid);
		$query=$this->db->get('commission_request');
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}*/

	public function messages($limit, $offset){
			$this->db->where('admin_id', customer_id());
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$this->db->order_by('id', 'desc');		
				$query=$this->db->get('messages');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('messages');
				return $query->num_rows();
			}
	}

	

}
