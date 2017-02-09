<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Superadmin_model extends CI_Model {

		public function insert($table_name='',  $data=''){
			$query=$this->db->insert($table_name, $data);
			if($query)
				return  $this->db->insert_id();
			else
				return FALSE;		
		}

		public function get_result($table_name='', $id_array=''){
			if(!empty($id_array)):		
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
				}
			endif;

			$query=$this->db->get($table_name);
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function get_row($table_name='', $id_array=''){
			if(!empty($id_array)):		
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
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

		public function total_orders_this_month(){
			$date=date('Y-m');
			$this->db->where('is_cancelled', 0);
			$this->db->where('order_status !=', 5);
			$this->db->like('created',$date,'after');		
			$this->db->from('orders');
			return $this->db->count_all_results();			
		}


		public function approved_stores($limit, $offset, $storename, $storeid){		
			$this->db->select('users.firstname,users.lastname,stores.*');
			$this->db->order_by('stores.id', 'desc');
			$this->db->where('stores.status', 1);
			$this->db->where('is_processed', 1);
			$this->db->where('users.user_role !=', 0);
			$this->db->from('stores');
			$this->db->join('users','users.id=stores.user_id');
			//$this->db->where('users.user_role',2);

			if($storeid !="-" && !empty($storeid))
				$this->db->like('stores.id', $storeid);

			if($storename !="-" && !empty($storename))
				$this->db->like('stores.store_name', $storename);

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}
		
		

		public function pending_stores($limit, $offset, $storename, $storeid){		
			$this->db->select('users.firstname,users.lastname,stores.*');
			$this->db->order_by('stores.id', 'desc');	
			$this->db->where('stores.status', 0);
			$this->db->where('users.user_role !=', 0);
			$this->db->from('stores');
			$this->db->join('users','users.id=stores.user_id');

			if($storeid !="-" && !empty($storeid))
				$this->db->like('stores.id', $storeid);

			if($storename !="-" && !empty($storename))
				$this->db->like('stores.store_name', $storename);

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function get_incomplete_stores(){

			$this->db->select('id');
			$this->db->where('is_processed',0);
			$query=$this->db->get('stores');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function get_designs_array($store_ids){
			
			$this->db->select('dsn.id, dsn.design_image');
			$this->db->from('design as dsn');
			$this->db->where_in('st_dsn.store_id', $store_ids);
			$this->db->join('design_to_multistore as st_dsn', 'dsn.id = st_dsn.design_id');
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function get_store_user($user_id){
	        $this->db->select('users.*,stores.store_name');
	        $this->db->where('users.id',$user_id);
	        $this->db->from('users');
	        $this->db->join('stores' , 'stores.user_id = users.id');
	        $query = $this->db->get();
	        if($query->num_rows()>0)
	            return $query->row();
	        else
	            return FALSE;

	    }

	    public function get_customer_service($user_id){
	        $this->db->where('id',$user_id);
	        $this->db->where('user_role',1);
	        $query = $this->db->get('users');
	        if($query->num_rows()>0)
	            return $query->row();
	        else
	            return FALSE;

	    }


	    public function update_store_user($user,$store_name,$user_id){
	        $data=array('store_name'=>$store_name);
	            $this->db->where('id',$user_id);
	            $this->db->update('users',$user);
	            // $this->db->where('user_id',$user_id);
	            // $this->db->update('stores',$data);
	    }

		// public function stores($limit, $offset){		
		// 	$this->db->select('users.firstname,users.lastname,stores.*');
		// 	$this->db->order_by('stores.id', 'desc');			
		// 	$this->db->from('stores');
		// 	$this->db->join('users','users.id=stores.user_id');
		// 	$this->db->where('user_role',2);		
		// 	if($limit > 0 && $offset>=0){
		// 		$this->db->limit($limit, $offset);
		// 		$query=$this->db->get();
		// 		if($query->num_rows()>0)
		// 			return $query->result();
		// 		else
		// 			return FALSE;
		// 	}else{
		// 		$query=$this->db->get();
		// 		return $query->num_rows();
		// 	}
		// }

		public function get_store($id){		
			$this->db->select('users.firstname,users.id as user_id,users.mobile,users.lastname,stores.*');
			$this->db->where('stores.id', $id);
			$this->db->from('stores');
			$this->db->join('users','users.id=stores.user_id');
			$this->db->where('user_role',3);				
			$query=$this->db->get();
			if($query->num_rows() > 0)
				return $query->row();
			else
				return FALSE;
		}


		public function supports($limit, $offset){				
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');			
				$query=$this->db->get('supports');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$this->db->order_by('id', 'desc');						
				$query=$this->db->get('supports');
				return $query->num_rows();
			}
		}

		public function store_admins1($limit, $offset, $fname='', $lname='', $email='', $user_id=''){				
				//$this->db->where('user_role',3);
				//$this->db->where('is_storeadmin',1);
				$this->db->order_by('id', 'desc');	

				if($fname != ""){
					$this->db->like('firstname', $fname);
				}

				if($lname != ""){
					$this->db->like('lastname', $lname);
				}

				if($email != ""){
					$this->db->like('email', $email);
				}

				if($user_id != ""){
					$this->db->where('id', $user_id);
				}

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('users');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				// $this->db->where('user_role',2);
				// $this->db->order_by('id', 'desc');			
				$query=$this->db->get('users');
				return $query->num_rows();
			}
		}


public function design_seller($limit, $offset, $fname='', $lname='', $email='', $user_id=''){				
				$this->db->where('user_role',3);
				$this->db->where('is_storeadmin',0);
				$this->db->order_by('id', 'desc');	

				if($fname != ""){
					$this->db->like('firstname', $fname);
				}

				if($lname != ""){
					$this->db->like('lastname', $lname);
				}

				if($email != ""){
					$this->db->like('email', $email);
				}

				if($user_id != ""){
					$this->db->where('id', $user_id);
				}

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('users');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				// $this->db->where('user_role',2);
				// $this->db->order_by('id', 'desc');			
				$query=$this->db->get('users');
				return $query->num_rows();
			}
		}

		public function best_seller($limit, $offset){				
				
				$this->db->order_by('id', 'desc');	

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('best_seller');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
							
				$query=$this->db->get('best_seller');
				return $query->num_rows();
			}
		}

		public function store_admins($limit, $offset, $fname='', $lname='', $email='', $user_id=''){				
				$this->db->where('user_role',3);
				$this->db->where('is_storeadmin',1);
				$this->db->order_by('id', 'desc');	

				if($fname != ""){
					$this->db->like('firstname', $fname);
				}

				if($lname != ""){
					$this->db->like('lastname', $lname);
				}

				if($email != ""){
					$this->db->like('email', $email);
				}

				if($user_id != ""){
					$this->db->where('id', $user_id);
				}

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('users');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				// $this->db->where('user_role',2);
				// $this->db->order_by('id', 'desc');			
				$query=$this->db->get('users');
				return $query->num_rows();
			}
		}

		public function customer_service($limit, $offset, $fname='', $lname='', $email='', $user_id=''){				
				$this->db->where('user_role',1);
				
				$this->db->order_by('id', 'desc');	

				if($fname != "-" && !empty($fname)){
					$this->db->like('firstname', $fname);
				}

				if($lname != "-" && !empty($lname)){
					$this->db->like('lastname', $lname);
				}

				if($email != "-" && !empty($email)){
					$this->db->like('email', $email);
				}

				if($user_id != "-" && !empty($user_id)){
					$this->db->where('id', $user_id);
					
				}

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('users');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				// $this->db->where('user_role',2);
				// $this->db->order_by('id', 'desc');			
				$query=$this->db->get('users');
				return $query->num_rows();
			}
		}

		// public function get_admins_for_msg($admin_ids, $all_admins){
			
		// 	$this->db->select('id,firstname, lastname, email');

		// 	if($all_admins != '1')
		// 		$this->db->where_in('id',$admin_ids);

		// 	$this->db->where('user_role',3);
		// 	$this->db->where('is_storeadmin',1);
		// 	$this->db->order_by('id', 'desc');
		// 	$query=$this->db->get('users');
		// 	if($query->num_rows()>0)
		// 		return $query->result();
		// 	else
		// 		return FALSE;
		// }

		public function get_admins_for_msg($admin_ids, $all_admins){
			

			$this->db->select('id,firstname, lastname, email');

			if($all_admins != '1')
				$this->db->where_in('id',$admin_ids);
			// else
			// 	$this->db->where('id',$admin_ids[0]);
			// $this->db->where('user_role',3);
			// $this->db->where('is_storeadmin',1);
			$this->db->order_by('id', 'desc');
			$query=$this->db->get('users');

			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}


		public function get_buyers_for_msg($orders_ids){
			
			$this->db->select('byr.recipient_name, byr.email, od.order_id');
			$this->db->from('buyers as byr');
			$this->db->join('orders as od','od.buyer_id=byr.id');
			$this->db->where_in('od.order_id',$orders_ids);
			$this->db->order_by('byr.id', 'desc');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}


		public function pages($limit, $offset){				
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$this->db->order_by('id', 'desc');			
				$query=$this->db->get('pages');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('pages');

				return $query->num_rows();
			}
		}

		public function uploaded_designs($storeid){
			$this->db->select('dsn.*');
			$this->db->from('design as dsn');
			$this->db->where('st_dsn.store_id', $storeid);
			$this->db->join('design_to_multistore as st_dsn', 'dsn.id = st_dsn.design_id');
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function orders($limit, $offset, $search="",$search_email="",$search_name="",$search_number='',$search_order_date="",$status=""){		
			// echo($search); die();
		    // $store_arr = get_store_id($admin_id);
			//$this->db->where('oi.store_id', $store_arr[0]->id);
			// $stores_id=array();
			// foreach ($store_arr as $row) {
			// 	$stores_id[]=$row->id;
			// }
			// if(is_array($stores_id))
			// 	$this->db->where_in('oi.store_id', $stores_id);

			// $this->db->where('o.order_status !=',5);
			$this->db->order_by('o.id', 'desc');
			if($search !=""){
				$this->db->like('o.order_id', $search);
			}
			if($search_email !=""){
				$this->db->like('b.email', $search_email);
			}
			if($status !=""){
				if($status !="null")
				{
				$this->db->like('o.order_status', $status);
			}}
			if($search_name !="")
			{
				$this->db->like('b.recipient_name', $search_name);	
			}
			if($search_number !="")
			{
				$this->db->like('b.phone', $search_number);	
			}
			if($search_order_date !="")
			{
				$search_date=date('Y-m-d', strtotime($search_order_date));

				$this->db->like('o.created', $search_date);

			}
			
			if($search_email !='' or $search_name!='' or $search_order_date !=''  or $search_number !="" )
			{
				 $this->db->select('o.id as order_id1,o.order_id,o.order_status,o.created as order_created,b.*');

				$this->db->from('buyers as b');
				$this->db->join('orders as o', 'o.buyer_id = b.id');
			
				if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();						
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
				}
			}
			else{

				$this->db->select('o.*,oi.order_id as order_item_id');
				$this->db->from('orders as o');
				$this->db->join('order_items as oi', 'oi.order_id = o.id');
				
				$this->db->group_by('o.id');

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
	  	}
	  	

	  	public function new_orders($limit,$offset,$search="",$search_email="",$search_name="")
	  	{	
	  		if($search !=""){
				$this->db->like('o.order_id', $search);
			}
			if($search_email !=""){
				$this->db->like('b.email', $search_email);
			}
			if($search_name !="")
			{
				$this->db->like('b.recipient_name', $search_name);	
			}

	  		if($search_email !='' or $search_name!='')
			{
				$this->db->order_by('o.created', 'desc');
				$this->db->select('o.id as order_id1,o.order_id,o.order_status,o.created ,b.*');
				
				$this->db->from(' buyers as b');
				//$this->db->join('order_items as oi', 'oi.order_id = o.id');

				$this->db->join('orders as o', 'o.buyer_id = b.id ');
				if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();						
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
				}
			}
			else{
	  		$this->db->order_by('o.created', 'desc');
	  		$this->db->select('*');
	  		//$this->db->where('o.store_id', $store_id);
	  		$this->db->limit($limit, $offset);
	  		$query=$this->db->get('orders as o');
	  		if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}
	  	}


		public function old_orders($limit,$offset,$search="",$search_email="",$search_name="")
	  	{
	  		if($search !=""){
				$this->db->like('o.order_id', $search);
			}
			if($search_email !=""){
				$this->db->like('b.email', $search_email);
			}
			if($search_name !="")
			{
				$this->db->like('b.recipient_name', $search_name);	
			}

	  		if($search_email !='' or $search_name!='')
			{
				$this->db->order_by('o.created', 'asc');
				$this->db->select('o.id as order_id1,o.order_id,o.order_status,o.created,b.*');
				$this->db->from('buyers as b');
				//$this->db->join('order_items as oi', 'oi.order_id = o.id');

				$this->db->join('orders as o', 'o.buyer_id = b.id ');
				if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();						
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
				}
			}
			else{

	  		$this->db->order_by('o.created', 'asc');
	  		$this->db->select('*');
	  		
	  		$this->db->limit($limit, $offset);
	  		$query=$this->db->get('orders as o');
	  		if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}
	  	}

		public function delete_orders($data)
		{
			foreach ($data as $key => $value) {
				$this->db->where('order_id', $value);	
				$this->db->delete('orders');
			}
		}


	  	public function order_user_info($order_id){
			$this->db->select('orders.*, buyers.billing_name, buyers.recipient_name, buyers.email, buyers.biling_adrs_same_2_adrs, buyers.billing_address, buyers.delivery_address, buyers.city, buyers.state, buyers.country, buyers.zip_code, buyers.phone, buyers.is_gift, buyers.shipping_method, buyers.shipping_info, buyers.shipping_city2, buyers.shipping_state2, buyers.shipping_zip2, buyers.say_something');
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

		public function products($limit, $offset, $type, $month, $year){			
			$this->db->where('is_customized', 0);
			$this->db->where('admin_custom', 0);
			$this->db->where('product_used', 0);
			$this->db->order_by('id', 'desc');

			if($type == "month")
				$this->db->like('created', date('Y-m', strtotime($month.' '.$year)));
			elseif($type == "year")
				$this->db->like('created',$year);

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get('products');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('products');
				return $query->num_rows();
			}
		}

		// public function display_products($limit, $offset, $type, $month="", $year=""){	
		// 	$this->db->where('is_customized', 0);
		// 	$this->db->order_by('id', 'desc');
		// 	if($type == "month"){
		// 		$this->db->like('created', date('Y-m', strtotime($month.' '.$year)));
		// 	}elseif($type == "year"){
		// 		$this->db->like('created',$year);
		// 	}	
		// 	if($limit > 0 && $offset>=0){
		// 	$this->db->limit($limit, $offset);	
		// 	$query=$this->db->get('products');			
		// 	if($query->num_rows()>0)
		// 		return $query->result();
		// 	else
		// 		return FALSE;
		// 	}else{
		// 		$query=$this->db->get('products');
		// 		return $query->num_rows();
		// 	}
		// }

		public function colors($product_id){				
				$this->db->order_by('id', 'desc');	
				$this->db->where('product_id', $product_id);				
				$this->db->where('is_default', 0);
				$query=$this->db->get('product_colors');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;	
		}


		public function color_n_images($color_id){
			$this->db->where('id', $color_id);		
			$query = $this->db->get('product_colors');
			$data['color'] = $query->row();

			$this->db->where('color_id', $color_id);		
			$query0 = $this->db->get('product_images');
			$data['images'] = $query0->result();

			$this->db->where('id', $data['color']->product_id);		
			$query1 = $this->db->get('products');

			$data['product'] = $query1->row();

			if(!empty($data['color']) || !empty($data['images']))
				return $data;
			else
				return FALSE;
		}

		public function get_product($product_id){
			$this->db->select('p.*, grp.group_name');
			$this->db->from('products as p');
			$this->db->where('p.id', $product_id);		
			$this->db->join('product_group as grp', 'grp.id = p.group_id');
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->row();
			else
				return FALSE;
		}

		public function get_products_categories($cat_ids){
			$this->db->select('id, category_name');
			$this->db->from('design_category');
			$this->db->where_in('id', $cat_ids);
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return FALSE;
		}


		// public function get_colors($product_id){
		// 	$this->db->select('c.color_code,pi.image_name,pi.color_id,pi.view');
		// 	$this->db->from('product_colors as c');
		// 	$this->db->where('c.product_id', $product_id);
		// 	$query = $this->db->get();
		// 	return $query->result();
		// }

		/*form*/

		public function form_fields($limit='',$offset=''){
			$this->db->select('*');
			$this->db->from('form_fields');
			$this->db->order_by('id','desc');		

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function forms($limit='',$offset=''){
			$this->db->select('*');
			$this->db->from('forms');
			$this->db->order_by('id','desc');		

			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function get_fields($fields=''){			
			$this->db->where_in('id',$fields);			
			$query=$this->db->get('form_fields');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;	
		}


		/*form*/

		public function faqs($limit, $offset, $user_id){				
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);	
				// $this->db->where('user_id', $user_id);		
				$this->db->order_by('id', 'desc');			
				$query=$this->db->get('faq');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('faq');

				return $query->num_rows();
			}
		}


		public function sizes($limit, $offset){				
			$this->db->order_by('id', 'desc');			
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get('product_sizes');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('product_sizes');
				return $query->num_rows();
			}
		}

		public function product_group($limit, $offset){				
			$this->db->order_by('id', 'desc');			
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get('product_group');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('product_group');
				return $query->num_rows();
			}
		}
		

		public function design_categories($limit, $offset){				
			$this->db->order_by('id', 'desc');			
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get('design_category');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('design_category');
				return $query->num_rows();
			}
		}

		public function categories($limit, $offset){				
			$this->db->order_by('id', 'desc');			
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get('design_category');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('design_category');
				return $query->num_rows();
			}
		}


		public function order_notes($order_id, $limit, $offset){
			$this->db->where('order_id', $order_id);
			$this->db->order_by('id', 'desc');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get('order_notes');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('order_notes');
				return $query->num_rows();
			}
		}

		public function designs($limit, $offset,$design_id, $artist, $keyword,$design_status){						

				$this->db->select('dsn.*');
				$this->db->from('design as dsn');
				// $this->db->where('str.status', 1);
				//$this->db->join('design_to_multistore as st_dsn', 'dsn.id = st_dsn.design_id');
				//$this->db->join('stores as str', 'str.id = st_dsn.store_id');
				$this->db->order_by('dsn.status', 'ASC');
				$this->db->order_by('dsn.id', 'DESC');
				$this->db->group_by('dsn.id');

				if($design_id != "-" && !empty($design_id)){
					$this->db->like('dsn.id', $design_id);
				}

				if($artist != "-" && !empty($artist)){
					$this->db->like('dsn.artist', $artist);
				}

				if($keyword != "-" && !empty($keyword)){
					$this->db->like('dsn.design_title', $keyword);
				}

				if($design_status == 1 || $design_status == 3){
					if($design_status==3){$design_status=0;}
					$this->db->like('status', $design_status);
				}

			if($limit > 0 && $offset >= 0){
				$this->db->limit($limit, $offset);
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{					
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

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

		// Waseem's Done

	public function store_detail($store_id)
	{
		$this->db->where('stores.id',$store_id);		
		$this->db->from('stores');
		$this->db->join('users','users.id=stores.user_id');
		$query=$this->db->get();
		return $query->row();
	}

		/////////ritesh for dash board////////////


	  public function get_user()
	  {

	    $query=$this->db->get('users');
	    return $query->num_rows();
	  }
	  public function get_orders()
	  {
	  	$this->db->select('o.*,oi.order_id as order_item_id');
		$this->db->from('orders as o');
		$this->db->join('order_items as oi', 'oi.order_id = o.id');
		
		$this->db->group_by('o.id');

	    $query=$this->db->get('orders');
	    return $query->num_rows();
	  }
	  public function get_items()
	  {
	  	$this->db->select_sum('quantity');
	    $query=$this->db->get('order_items');
	    // print_r($query); die();
	    
	    return $num_rows=$query->row()->quantity;
	  }
	  public function items()
	  {
	    $this->db->select('quantity,created');
	    $query=$this->db->get('order_items');
	    return $result=$query->result();
	  }
	  public function store()
	  {
	  	$stores = array();
	  	 $this->db->select('users.firstname,users.lastname,stores.*');
			$this->db->order_by('stores.id', 'desc');
			$this->db->where('stores.status', 0);
			$this->db->where('is_processed', 1);
			$this->db->where('users.user_role !=', 0);
			//$this->db->from('stores');
			$this->db->join('users','users.id=stores.user_id');
			//$this->db->where('user_role',2);
	  	// $this->db->where('status', 0);
	  	// $this->db->where('is_processed', 1);
		    $query=$this->db->get('stores');
		    $stores['pending'] = $query->num_rows();



	   		$this->db->select('users.firstname,users.lastname,stores.*');
			$this->db->order_by('stores.id', 'desc');
			$this->db->where('stores.status', 1);
			$this->db->where('is_processed', 1);
			$this->db->where('users.user_role !=', 0);
			//$this->db->from('stores');
			$this->db->join('users','users.id=stores.user_id');
			//$this->db->where('user_role',2);
	   
	   // $this->db->where('status', 1);
	    //$this->db->where('is_processed', 1);
	    $query=$this->db->get('stores');
	    $stores['approved'] = $query->num_rows();//$query->num_rows() - 1

	    return $stores;
	  }

	  public function get_default_prod_id(){
			$this->db->select('id');
			$this->db->from('products');
			$this->db->limit(1, 0);
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->row()->id;
			else
				return FALSE;
	  }

	public function select_design($data = '', $design = '')
	{

	  		if ($data == '' || $design == '') {
	  			$this->session->set_flashdata('error_msg'," Design info is missing, cannot proccess.");
				redirect('superadmin/products');
	  		}
	  		foreach ($design as $value) {
	  			$this->db->set('design_id', $value);
	  			$this->db->set('product_id', $data['product_id']);
	  			$this->db->set('created', $data['created']);
	  			$this->db->insert('product_designs');
	  		}
	}

	  public function update_product_design($data = '', $design = '', $selected = ''){

	  		if ($data == '' || $design == '') {
	  			$this->session->set_flashdata('error_msg'," Design info is missing, cannot proccess.");
				redirect('superadmin/products');
	  		}
			$delete = array();
			foreach ($design as $key => $new) {
				if (!element($new, $selected)){				
					$this->db->set('design_id', $new);
	  				$this->db->set('product_id', $data['product_id']);
	  				$this->db->set('created', $data['created']);
	  				$this->db->set('updated', $data['updated']);
	  				$this->db->insert('product_designs');
				}else{
					unset($selected[$new]);
				}

			}

			if (!empty($selected)) {
				foreach ($selected as $d => $pd) {
					$this->db->delete('product_designs', array('id' => $pd));
				}
			}
	  }


	  public function delete_product_design($product_id = '', $design = ''){

	  		$deleted = 0;
	  		if ($product_id == '' || $design == '') {
	  			$this->session->set_flashdata('error_msg'," Design info is missing, cannot proccess.");
				redirect('superadmin/products');
	  		}

	  		foreach ($design as $id) {
	  			$this->db->where('design_id', $id);
	  			$this->db->where('product_id', $product_id);
	  			$status = $this->db->delete('product_designs');
	  			if ($status)
	  				$deleted++;
	  		}

	  		if ($deleted != 0 )
	  			return TRUE;
	  		else
	  			return FALSE;
	  }

	  public function designs_for_select($limit, $offset,$product_id =''){
			$this->db->where('status', 1);
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				if(!empty($product_id))
					$this->db->where('product_id',$product_id);
				$this->db->order_by('id', 'desc');			
				$query=$this->db->get('design');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{					
				$query=$this->db->get('design');
				return $query->num_rows();
			}
	  }



	  public function selected_designs_id($product_id){
	  	
		$this->db->where('product_id', $product_id);
		$this->db->order_by('id', 'desc');			
		$query=$this->db->get('product_designs');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	  }

	  public function selected_prod_designs($product_id, $limit, $offset){
			if($limit > 0 && $offset>=0){
				$this->db->where('prod_d.product_id', $product_id);
				$this->db->select('prod_d.*,ds.design_title, ds.design_image');
				$this->db->from('product_designs as prod_d');
				$this->db->join('design as ds', 'ds.id = prod_d.design_id');
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');
				$this->db->group_by('id');
				$query=$this->db->get('product_designs');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{					
				$this->db->where('product_id', $product_id);
				$query=$this->db->get('product_designs');
				return $query->num_rows();
			}
		}

		 public function pay_request($limit, $offset){
		 	$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email,us_pay.payee_type');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 0);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('request_date', 'desc');
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		 public function pay_request_approve($limit, $offset){
		 	$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email,us_pay.payee_type');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 1);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('payment_date', 'desc');
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function paypal_users($limit, $offset){
		 	$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.payee_type', 2);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function get_users_for_pay($user_ids=''){

			if (empty($user_ids)){
				$this->session->set_flashdata('error_msg', 'No Users are selected for the process.');
				redirect('superadmin/paypal_users');
			}

		 	$this->db->select('rqst.unpaid_com,rqst.total_paid_com,us_pay.paypal_email,us_pay.user_id');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.unpaid_com >= ', 25);
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.payee_type', 2);
			$this->db->where_in('us_pay.user_id', $user_ids);
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = rqst.user_id');
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}


		public function slider_settings($limit, $offset){
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');			
				$query=$this->db->get('sliders');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$this->db->order_by('id', 'desc');						
				$query=$this->db->get('sliders');
				return $query->num_rows();
			}
		}

		public function get_order_date_wise(){
			$date = explode('-', date("Y-m-d"));
			$check_param = $date[0]."-".$date[1]."-%";
			$this->db->select('SUM(oi.quantity) as total_qty, SUM(oi.subtotal) as day_sell, oi.created');
			$this->db->from('order_items as oi');
			$this->db->where('oi.created LIKE', $check_param);
			$this->db->group_by('oi.created');
			$query = $this->db->get();
			// print_r($query->result());
			// die();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function get_support_notification(){
			$this->db->select('sup.superadmin_replied as notification,');
			$this->db->from('supports as sup');
			$this->db->where('sup.superadmin_replied', 0);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->num_rows();
			else
				return 0;
		}

		public function get_pending_designs(){
			$this->db->select('id');
			$this->db->from('design');
			$this->db->where('status', 0);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->num_rows();
			else
				return 0;
		}

		public function coupons($limit, $offset){				
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$this->db->order_by('id', 'desc');		
				$query=$this->db->get('coupons');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('coupons');
				return $query->num_rows();
			}
		}

		public function store_custom_product($limit, $offset, $sort_base, $month, $year){
			$this->db->select('prod.*,st.store_name');
			$this->db->from('products as prod');
			$this->db->where('prod.admin_custom', 1);
			$this->db->join('stores as st','st.id=prod.store_id');
			$this->db->order_by('prod.id', 'desc');
			if($sort_base == "month"){
				$this->db->like('prod.created', date('Y-m', strtotime($month.' '.$year)));
			}elseif($sort_base == "year"){
				$this->db->like('prod.created',$year);
			}
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

		public function get_custom_product($product_id){
			$this->db->select('p.*, grp.group_name, st.store_name');
			$this->db->from('products as p');
			$this->db->where('p.id', $product_id);		
			$this->db->join('stores as st', 'st.id = p.store_id');
			$this->db->join('product_group as grp', 'grp.id = p.group_id');
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->row();
			else
				return FALSE;
		}

		public function messages($limit, $offset){				
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
	
	 public function user_pay_request_bank($limit, $offset){
		 	$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email,us_pay.acc_holder,us_pay.acc_type,us_pay.acc_holder,us_pay.bank_name,us_pay.acc_no,us_pay.routing_no');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.payee_type', 1);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}

	 public function user_pay_request_cheque($limit, $offset){
		 	$this->db->select('rqst.*,us.id as userid, us.firstname,us.lastname,us.email,us_pay.full_name,us_pay.address');
			$this->db->from('commission_request as rqst');
			$this->db->where('rqst.pay_status', 0);
			$this->db->where('us_pay.payee_type', 3);
		 	$this->db->join('users as us', 'us.id = rqst.user_id');
		 	$this->db->join('user_payee_info as us_pay', 'us_pay.user_id = us.id');
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);
				$this->db->order_by('id', 'desc');
				$query=$this->db->get();
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get();
				return $query->num_rows();
			}
		}
}/* End of file superadmin_model.php */
