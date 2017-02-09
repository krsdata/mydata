<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model {	

	public function insert($table_name='',  $data=''){
		$query=$this->db->insert($table_name, $data);
		if($query)
			return  $this->db->insert_id();
		else
			return FALSE;		
	}

	public function get_result($table_name='', $id_array='', $columns=array(),$order_by=array()){
		
		if(!empty($columns)):
		$all_columns = implode(",", $columns);
		$this->db->select($all_columns);
		endif;

		if(!empty($order_by)):	
		$this->db->order_by($order_by[0], $order_by[1]);
		endif; 

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

	public function check_link($url){
		$query = $this->db->get_where('stores', array('store_link' => $url));
		if($query->num_rows() > 0){
			return $query->row()->id;
		}
	}

	public function designs($limit, $offset, $user_id=""){				
		
		$this->db->where('status',1);
		if($user_id !=""){
			$this->db->where('artist_id', $user_id);
		}
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);						
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

	public function design_category()
	{
		//$this->db->order_by('category_order');
		$this->db->order_by('id');
		$query = $this->db->get_where('design_category');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return FALSE;
		}

	}

	public function sort_designs($limit, $offset, $cat_id=0, $user_id=""){
		
		if($cat_id != 0){
			$value = $this->get_result('design', array('status'=>1));
			if (!$value)
			{
				return FALSE;
			}
			$arr = array();
			foreach ($value as $key){	
				$cat = unserialize($key->category);
				if(in_array($cat_id, $cat)){
					$arr []= $key->id;
				}
			}

			if (empty($arr))
			{
				return FALSE;
			}

			$this->db->where_in('id', $arr);

		}
		
		if($user_id !=""){
			// echo "UserId = ".$user_id;
			$this->db->where('artist_id', $user_id);
		}
		// die();
		$this->db->where('status', 1);
		
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

	public function sort_by_params($limit, $offset, $sort='newest', $user_id=""){
		$this->db->select('dsn.*');
		$this->db->from('design as dsn');
		if($user_id !=""){
			$this->db->where('dsn.artist_id', $user_id);
		}
		$this->db->where('dsn.status', 1);

		if($sort == 'newest'){
			$this->db->order_by('dsn.created', 'DESC');
		}elseif($sort == 'best_selling'){
			$this->db->order_by('dsn.total_sold_qty', 'DESC');
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

	public function product_categories($limit, $offset){				
		$this->db->order_by('id', 'desc');			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);			
			$query=$this->db->get('product_category');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$query=$this->db->get('product_category');
			return $query->num_rows();
		}
	}
	


	public function products($limit, $offset){			
			$this->db->order_by('id', 'desc');						
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

	public function get_product($product_id){
		$this->db->select('p.*, g.group_name');
		$this->db->from('products as p');
		$this->db->where('p.id', $product_id);		
		$this->db->where('p.product_status', 1);		
		$this->db->join('product_group as g', 'g.id = p.group_id');
		$query = $this->db->get();
		//print_r($query->row()); die();
		if($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

	// public function get_products_for_editor($group, $cat_id){

	// 	if ($cat_id != 0) {
	// 		$prod = $this->get_result('products', array('product_status'=>1, 'is_customized' => 0));
	// 		if (!$prod)
	// 		{
	// 			return FALSE;
	// 		}
	// 		$category_arr = array();
	// 		foreach ($prod as $key){
	// 			$cat = unserialize($key->category_id);
	// 			if ($cat) {
	// 				if(in_array($cat_id, $cat)){
	// 					$category_arr[]= $key->id;
	// 				}
	// 			}
	// 		}
	// 	}

	// 	$this->db->select('p.*');
	// 	$this->db->from('products as p');
	// 	$this->db->where('p.product_status', 1);
	// 	$this->db->where('p.is_customized', 0);
	// 	if ($group != 0) {
	// 		$this->db->join('product_group as g', 'g.id = p.group_id');
	// 		$this->db->where('p.group_id', $group);
	// 	}
	// 	if ($cat_id != 0) {
	// 		$this->db->where_in('p.id', $category_arr);
	// 	}
		
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 		return $query->result();
	// 	else
	// 		return FALSE;
	// }

	public function get_products_for_editor($filter){

		if (!empty($filter['category'])) {
			$prod = $this->get_result('products', array('product_status'=>1, 'is_customized' => 0, 'admin_custom' => 0));
			if (!$prod)
			{
				return FALSE;
			}
			$category_arr = array();
			foreach ($prod as $key){
				$cat = unserialize($key->category_id);
				if ($cat) {
					if(in_array($filter['category'], $cat)){
						$category_arr[] = $key->id;
					}
				}
			}
		}

		$this->db->select('p.*');
		$this->db->from('products as p');
		$this->db->where('p.product_status', 1);
		$this->db->where('p.is_customized', 0);
		if (!empty($filter['group'])) {
			$this->db->join('product_group as g', 'g.id = p.group_id');
			$this->db->where('p.group_id', $filter['group']);
		}
		if (!empty($category_arr))
			$this->db->where_in('p.id', $category_arr);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_designs_for_editor($category){

		
		$design = $this->get_result('design', array('status'=>1));

		if (!$design)
			return FALSE;

		$category_arr = array();

		foreach ($design as $key){
			$cat = unserialize($key->category);
			if ($cat) {
				if(in_array($category, $cat)){
					$category_arr[] = $key->id;
				}
			}
		}

		if (empty($category_arr))
			return FALSE;

		$this->db->where('status', 1);

		$this->db->where_in('id', $category_arr);
		
		$query = $this->db->get('design');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_prod_size($size_id){
		$this->db->select('id, size_name');
		$this->db->from('product_sizes');
		$this->db->where_in('id', $size_id);				
		$query = $this->db->get();
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_prod_col($product_id){
		$this->db->select('id, color_code');
		$this->db->from('product_colors');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}


	public function get_color_code($id){
		$this->db->select('color_code');
		$this->db->where('id', $id);				
		$query = $this->db->get('product_colors');
		if($query->num_rows() > 0)
			return $query->row()->color_code;
		else
			return FALSE;
	}

	public function get_size($id){
		$this->db->select('size_name');
		$this->db->where('id', $id);				
		$query = $this->db->get('product_sizes');
		if($query->num_rows() > 0)
			return $query->row()->size_name;
		else
			return FALSE;
	}


	public function get_default_prod_id(){
		$this->db->select('id');
		$this->db->from('products');
		$this->db->where('is_customized', 0);
		$this->db->limit(1, 0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return FALSE;
	}

	public function get_prod_image($prod_id = ''){
		$this->db->select('main_image');
		$this->db->from('products');
		$this->db->where('id', $prod_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->main_image;
		else
			return FALSE;
	}

	public function get_current_design($design_id = 0){
		$this->db->select('design_image');
		$this->db->from('design');
		if ($design_id == 0) {
			$this->db->limit(1, 0);
		}else{
			$this->db->where('id', $design_id);	
		}
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->design_image;
		else
			return FALSE;
	}

	public function get_default_color($product_id){
		$this->db->select('id, color_code');
		$this->db->from('product_colors');
		$this->db->where('product_id', $product_id);			
		$this->db->limit(1, 0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return FALSE;
	}
	
	public function get_col_img($product_id, $col_id){
		$this->db->select('id,product_id, image_name, view, color_id');
		$this->db->from('product_images as pro_img');
		$this->db->where('pro_img.product_id', $product_id);				
		$this->db->where('pro_img.color_id', $col_id);
		$query = $this->db->get();
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	public function check_customized($product_id){
		$this->db->select('is_customized');
		$this->db->where('id', $product_id);
		$query = $this->db->get('products');
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->row()->is_customized;
		else
			return 0;
	}



	public function stripe_update($amt,$token,$desc){
		$this->load->library('stripe');
		$stripe_res = $this->stripe->charge_card(($amt * 100), $token, $desc);
		$response = json_decode($stripe_res);
		if(@$response->paid == 1){
			$final_cart = $this->cart->contents();

			$cart_user_info = $this->session->userdata('cart_user_info');

			$buyer_id = $this->insert('buyers', $cart_user_info); //Buyer Entry

			foreach ($final_cart as $value) {
				$options = $value['options'];
				break;
			}

			$this->db->select('order_id');
			$this->db->limit(1);
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('orders');
			if($query->num_rows() == 1)
				$order_id = $query->row()->order_id + 1;
			else
				$order_id = rand('11111111', '99999999');

			$final_amounts = $this->session->userdata('grand_total');

			$data = array(
					'store_id'					=> $options['Store_id'],
					'buyer_id'					=> $buyer_id,
					'order_id'					=> $order_id,
					'gross_amount'				=> $final_amounts['gross_amount'],
					'total_amount'				=> $final_amounts['total_amount'],
					'discount'					=> $final_amounts['discount'],
					'tax_amount'				=> $final_amounts['shipping_handling'],
					'payment_method'			=> 'Stripe',
					'shipping_method'			=> 'Normal',
					'is_gift'					=> $cart_user_info['is_gift'],
					'biling_adrs_same_2_adrs'	=> $cart_user_info['biling_adrs_same_2_adrs'],
					'receive_email'				=> '0',
					'transaction_id' 			=> $response->id,
					'payment_status' 			=> 'paid',
					'other_payment_info' 		=> $stripe_res,
					'order_status'				=> 1,
					'created'					=> date('Y-m-d H:i:s')
				);

			$this->db->insert('orders', $data);

			$order_table_id = $this->db->insert_id();
			$t = TRUE;
			foreach ($final_cart as $value) {
				$options = $value['options'];
				if ($t) {
					$prdct = array(	
								'image' => $value['options']['Images'], 
								'title' => $value['name'],
								'path' => $value['options']['Path'],
						 );
					$this->session->set_userdata('first_product',$prdct);
					$t = FALSE;
				}

				$data = array(
					'order_id' 		=> $order_table_id,
					'product_id' 	=> $value['id'],
					'store_id'		=> $options['Store_id'],
					'color_id'		=> $options['Color_id'],
					'parameter_id'	=> $options['Size_id'],
					'quantity' 		=> $value['qty'],
					'price'			=> $value['price'],
					'subtotal'		=> $value['price'] * $value['qty'],
					'is_package'	=> $options['Is_package'],
					'is_customized'	=> $this->check_customized($value['id']),
					'cart_detail'	=> json_encode($value),
					'created'		=> date('Y-m-d')
					);
				$quantitty_multi=$value['qty'];
				$this->db->insert('order_items', $data);

				
				$front_img = $value['options']['Images'];
				$this->copy_images($front_img);
				$back_img = $value['options']['Back_Images'];
				$this->copy_images($back_img);

				$this->db->update('products', array('is_purchased' => 1), array('id' => $value['id']));

				$total1_sold_qty = $this->product_sold_qty($options['Product_used']);
				$total1_sold_qty += $value['qty'];
				$this->db->update('products', array('sold_qty' => $total1_sold_qty),array('id' => $options['Product_used']));

				if(!empty($value['options']['Design_id'])){
					$allvalue=unserialize($value['options']['Design_id']);
					foreach ($allvalue as $key => $val) {
						$d_id=$key;
						 $record['design_price']= $val['price'];
						 $record['total']=$val['price'];
						 $total_qty=$val['design_qty']* $quantitty_multi;
						 $prod_id=$value['options']['Product_id'];
						$data = array(
								'order_id'			=> $order_table_id,
								'product_id'		=> $prod_id,
								'design_id'			=> $d_id,
								'design_owner_id'	=> design_owner($d_id),
								'qty'				=> $total_qty,
								'price'				=> $record['design_price'],
								'total'				=> $record['total']* $total_qty,
								'created'			=> date('Y-m-d')
								);
							$this->db->insert('design_sales', $data);
							$total_sold_qty = $this->design_sold_qty($d_id);
							$total_sold_qty += $total_qty;
							$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
					}		
				}
			}



			/*if ($this->session->userdata('design_array')) {

				
				$products_designs = $this->session->userdata('design_array');
				$item_array = array();
				$products_designs = $this->session->userdata('design_array');
				foreach ($products_designs as $row_id => $prod_ids) {
					foreach ($prod_ids as $prod_id => $designs) {
						foreach ($designs as $d_id => $record) {
							if (isset($item_array[$prod_id][$d_id])) {
								$item_array[$prod_id][$d_id]['qty'] += $record['qty'];
								$item_array[$prod_id][$d_id]['total'] += $record['total'];
							} else {
								$item_array[$prod_id][$d_id] = $record;
							}
						}
					}
				}

				foreach ($item_array as $prod_id => $designs) {
					foreach ($designs as $d_id => $record) {
						$design_owner = design_owner($record['design_id']);
						$total_qty = $record['qty'] * $record['design_qty'];
						$data = array(
								'order_id'			=> $order_table_id,
								'product_id'		=> $prod_id,
								'design_id'			=> $d_id,
								'design_owner_id'	=> design_owner($d_id),
								'qty'				=> $total_qty,
								'price'				=> $record['design_price'],
								'total'				=> $record['total'],
								'created'			=> date('Y-m-d')
							);
						$this->db->insert('design_sales', $data);
						$total_sold_qty = $this->design_sold_qty($d_id);
						$total_sold_qty += $total_qty;
						$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
					}
				}

				if ($this->session->userdata('design_array')) {
					$this->session->set_userdata('design_array', '');
					$this->session->unset_userdata('design_array');
				}

				// if ($this->session->userdata('design_array1')) {
				// 	$this->session->set_userdata('design_array1', '');
				// 	$this->session->unset_userdata('design_array1');
				// }
			}*/

			$this->session->set_userdata('discount','');
        	$this->session->unset_userdata('discount');
        	$this->session->set_userdata('grand_total','');
        	$this->session->unset_userdata('grand_total');



			$this->load->library('smtp_lib/smtp_email');
			$subject = 'Shirtscore Order';	// Subject for email
			$from = array('no-reply@shirtscore.com' =>'Shirtscore.com');	// From email in array form
			$to = array(
				$cart_user_info['email']
			);
			
			// $html = "<h3> Your Order ID is <br> $order_id </h3> <br>";
			// $html .= "<h3> Your Order Tracking Link is <br> ".base_url()."store/order_tracking/".$order_id." </h3> <br>";
			$html = $this->template_for_purchasing_design($order_id);
			$this->smtp_email->sendEmail($from, $to, $subject, $html);
			$this->session->set_userdata('first_product ','');
        	$this->session->unset_userdata('first_product ');
        	$this->session->set_userdata('cart_user_info','');
        	$this->session->unset_userdata('cart_user_info');
        	$this->session->set_userdata('stripeData','');
        	$this->session->unset_userdata('stripeData');
			return $order_id;
		}
		else{
			return FALSE;
		}

	}
	
	public function payment_update($amt, $ref, $other){
		
			$final_cart = $this->cart->contents();

			$cart_user_info = $this->session->userdata('cart_user_info');

			$buyer_id = $this->insert('buyers', $cart_user_info); //Buyer Entry

			foreach ($final_cart as $value) {
				$options = $value['options'];
				break;
			}

			$this->db->select('order_id');
			$this->db->limit(1);
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('orders');
			if($query->num_rows() == 1)
				$order_id = $query->row()->order_id + 1;
			else
				$order_id = rand('11111111', '99999999');

			$final_amounts = $this->session->userdata('grand_total');

			$data = array(
					'store_id'					=> $options['Store_id'],
					'buyer_id'					=> $buyer_id,
					'order_id'					=> $order_id,
					'gross_amount'				=> $final_amounts['gross_amount'],
					'total_amount'				=> $final_amounts['total_amount'],
					'discount'					=> $final_amounts['discount'],
					'tax_amount'				=> $final_amounts['shipping_handling'],
					'payment_method'			=> 'Card',
					'shipping_method'			=> 'Normal',
					'is_gift'					=> $cart_user_info['is_gift'],
					'biling_adrs_same_2_adrs'	=> $cart_user_info['biling_adrs_same_2_adrs'],
					'receive_email'				=> '0',
					'transaction_id' 			=> $ref,
					'payment_status' 			=> 'paid',
					'other_payment_info' 		=> $other,
					'order_status'				=> 1,
					'created'					=> date('Y-m-d H:i:s')
				);

			$this->db->insert('orders', $data);

			$order_table_id = $this->db->insert_id();
			$t = TRUE;
			foreach ($final_cart as $value) {
				$options = $value['options'];
				if ($t) {
					$prdct = array(	
								'image' => $value['options']['Images'], 
								'title' => $value['name'],
								'path' => $value['options']['Path'],
						 );
					$this->session->set_userdata('first_product',$prdct);
					$t = FALSE;
				}

				$data = array(
					'order_id' 		=> $order_table_id,
					'product_id' 	=> $value['id'],
					'store_id'		=> $options['Store_id'],
					'color_id'		=> $options['Color_id'],
					'parameter_id'	=> $options['Size_id'],
					'quantity' 		=> $value['qty'],
					'price'			=> $value['price'],
					'subtotal'		=> $value['price'] * $value['qty'],
					'is_package'	=> $options['Is_package'],
					'is_customized'	=> $this->check_customized($value['id']),
					'cart_detail'	=> json_encode($value),
					'created'		=> date('Y-m-d')
					);
				$quantitty_multi=$value['qty'];
				$this->db->insert('order_items', $data);

				
				$front_img = $value['options']['Images'];
				$this->copy_images($front_img);
				$back_img = $value['options']['Back_Images'];
				$this->copy_images($back_img);

				$this->db->update('products', array('is_purchased' => 1), array('id' => $value['id']));

				$total1_sold_qty = $this->product_sold_qty($options['Product_used']);
				$total1_sold_qty += $value['qty'];
				$this->db->update('products', array('sold_qty' => $total1_sold_qty),array('id' => $options['Product_used']));

				if(!empty($value['options']['Design_id'])){
					$allvalue=unserialize($value['options']['Design_id']);
					foreach ($allvalue as $key => $val) {
						$d_id=$key;
						 $record['design_price']= $val['price'];
						 $record['total']=$val['price'];
						 $total_qty=$val['design_qty']* $quantitty_multi;
						 $prod_id=$value['options']['Product_id'];
						$data = array(
								'order_id'			=> $order_table_id,
								'product_id'		=> $prod_id,
								'design_id'			=> $d_id,
								'design_owner_id'	=> design_owner($d_id),
								'qty'				=> $total_qty,
								'price'				=> $record['design_price'],
								'total'				=> $record['total']* $total_qty,
								'created'			=> date('Y-m-d')
								);
							$this->db->insert('design_sales', $data);
							$total_sold_qty = $this->design_sold_qty($d_id);
							$total_sold_qty += $total_qty;
							$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
					}		
				}
			}



			/*if ($this->session->userdata('design_array')) {

				
				$products_designs = $this->session->userdata('design_array');
				$item_array = array();
				$products_designs = $this->session->userdata('design_array');
				foreach ($products_designs as $row_id => $prod_ids) {
					foreach ($prod_ids as $prod_id => $designs) {
						foreach ($designs as $d_id => $record) {
							if (isset($item_array[$prod_id][$d_id])) {
								$item_array[$prod_id][$d_id]['qty'] += $record['qty'];
								$item_array[$prod_id][$d_id]['total'] += $record['total'];
							} else {
								$item_array[$prod_id][$d_id] = $record;
							}
						}
					}
				}

				foreach ($item_array as $prod_id => $designs) {
					foreach ($designs as $d_id => $record) {
						$design_owner = design_owner($record['design_id']);
						$total_qty = $record['qty'] * $record['design_qty'];
						$data = array(
								'order_id'			=> $order_table_id,
								'product_id'		=> $prod_id,
								'design_id'			=> $d_id,
								'design_owner_id'	=> design_owner($d_id),
								'qty'				=> $total_qty,
								'price'				=> $record['design_price'],
								'total'				=> $record['total'],
								'created'			=> date('Y-m-d')
							);
						$this->db->insert('design_sales', $data);
						$total_sold_qty = $this->design_sold_qty($d_id);
						$total_sold_qty += $total_qty;
						$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
					}
				}

				if ($this->session->userdata('design_array')) {
					$this->session->set_userdata('design_array', '');
					$this->session->unset_userdata('design_array');
				}

				// if ($this->session->userdata('design_array1')) {
				// 	$this->session->set_userdata('design_array1', '');
				// 	$this->session->unset_userdata('design_array1');
				// }
			}*/

			$this->session->set_userdata('discount','');
        	$this->session->unset_userdata('discount');
        	$this->session->set_userdata('grand_total','');
        	$this->session->unset_userdata('grand_total');



			$this->load->library('smtp_lib/smtp_email');
			$subject = 'Shirtscore Order';	// Subject for email
			$from = array('no-reply@shirtscore.com' =>'Shirtscore.com');	// From email in array form
			$to = array(
				$cart_user_info['email']
			);
			
			// $html = "<h3> Your Order ID is <br> $order_id </h3> <br>";
			// $html .= "<h3> Your Order Tracking Link is <br> ".base_url()."store/order_tracking/".$order_id." </h3> <br>";
			$html = $this->template_for_purchasing_design($order_id);
			$this->smtp_email->sendEmail($from, $to, $subject, $html);
			$this->session->set_userdata('first_product ','');
        	$this->session->unset_userdata('first_product ');
        	$this->session->set_userdata('cart_user_info','');
        	$this->session->unset_userdata('cart_user_info');
        	$this->session->set_userdata('stripeData','');
        	$this->session->unset_userdata('stripeData');
			return $order_id;

	}

	public function copy_images($file = '')
	{
		$copy_scr1 = './assets/uploads/test/thumbnail/'.$file;
		$dest_thum1 = './assets/uploads/custom_prod_img/thumbnail/'.$file;
		if(is_file($copy_scr1)){
			copy($copy_scr1, $dest_thum1);
			@unlink($copy_scr1);
		}
		$copy_scr2 = './assets/uploads/test/temp/'.$file;
		$dest_thum2 = './assets/uploads/custom_prod_img/'.$file;
		if(is_file($copy_scr2)){
			copy($copy_scr2, $dest_thum2);
			@unlink($copy_scr2);
		}

		return ;
	}

	public function design_sold_qty($design_id)
	{
		$this->db->select('total_sold_qty');
		$this->db->where('id', $design_id);
		$query=$this->db->get('design');
		if($query->num_rows()>0){
			return $query->row()->total_sold_qty;
		}else{
			return 0;
		}
	}

	public function product_sold_qty($prod_id)
	{
		$this->db->select('sold_qty');
		$this->db->where('id', $prod_id);
		$query=$this->db->get('products');
		if($query->num_rows()>0){
			return $query->row()->sold_qty;
		}else{
			return 0;
		}
	}

	public function paypal_success(){
		$final_cart = $this->cart->contents();
		$cart_user_info = $this->session->userdata('cart_user_info');

		foreach ($final_cart as $value) {
			$options = $value['options'];
			break;
		}

		$this->db->select('order_id');
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('orders');
		if($query->num_rows() == 1)
			$order_id = $query->row()->order_id + 1;
		else
			$order_id = rand('11111111', '99999999');

		$cart_user_info = $this->session->userdata('cart_user_info');

		//print_r($cart_user_info);
		$buyer_id = $this->insert('buyers', $cart_user_info); //Buyer Entry
		$final_amounts = $this->session->userdata('grand_total');
		
		//print_r($final_amounts ); die;
		$data = array(
				'store_id'					=> $options['Store_id'],
				'buyer_id'					=> $buyer_id,
				'order_id'					=> $order_id,
				'gross_amount'				=> $final_amounts['gross_amount'],
				'total_amount'				=> $final_amounts['total_amount'],
				'discount'					=> $final_amounts['discount'],
				'tax_amount'				=> $final_amounts['shipping_handling'],
				'payment_method'			=> 'Paypal',
				'shipping_method'			=> 'Normal',
				'is_gift'					=> $cart_user_info['is_gift'],
				'biling_adrs_same_2_adrs'	=> $cart_user_info['biling_adrs_same_2_adrs'],
				'receive_email'				=> '0',
				'transaction_id' 			=> $this->input->post('txn_id'),
				'payment_status' 			=> 'paid',
				'other_payment_info' 		=> json_encode($_POST),
				'order_status'				=> 1,
				'created'					=> date('Y-m-d H:i:s')
			);

		$this->db->insert('orders', $data);

		$order_table_id = $this->db->insert_id();

		$t = TRUE;
		//print_r($final_cart);
		foreach ($final_cart as $value) {
			$options = $value['options'];
			//print_r($options);
			if ($t) {
				$prdct = array(	
								'image' => $value['options']['Images'], 
								'title' => $value['name'],
								'path' => $value['options']['Path'],
						 );
				$this->session->set_userdata('first_product',$prdct);
				$t = FALSE;
			}
			$data = array(
				'order_id' 		=> $order_table_id,
				'product_id' 	=> $value['id'],
				'store_id'		=> $options['Store_id'],
				'color_id'		=> $options['Color_id'],
				'parameter_id'	=> $options['Size_id'],
				'quantity' 		=> $value['qty'],
				'price'			=> $value['price'],
				'subtotal'		=> $value['price'] * $value['qty'],
				'is_package'	=> $options['Is_package'],
				'is_customized'	=> $this->check_customized($value['id']),
				'cart_detail'	=> json_encode($value),
				'created'		=> date('Y-m-d') 
				);
			$quantitty_multi=$value['qty'];
			$this->db->insert('order_items', $data);
			$front_img = $value['options']['Images'];
			$this->copy_images($front_img);
			$back_img = $value['options']['Back_Images'];
			$this->copy_images($back_img);
			$this->db->update('products', array('is_purchased' => 1), array('id' => $value['id']));
			//updating sold quantity
			$total1_sold_qty = $this->product_sold_qty($options['Product_used']);
			$total1_sold_qty += $value['qty'];
			$this->db->update('products', array('sold_qty' => $total1_sold_qty), array('id' => $options['Product_used']));

			if(!empty($value['options']['Design_id'])){
					$allvalue=unserialize($value['options']['Design_id']);
					foreach ($allvalue as $key => $val) {
						$d_id=$key;
						 $record['design_price']= $val['price'];
						 $record['total']=$val['price'];
						  $total_qty=$val['design_qty'] * $quantitty_multi;
						 
						 $prod_id=$value['options']['Product_id'];
						$data = array(
								'order_id'			=> $order_table_id,
								'product_id'		=> $prod_id,
								'design_id'			=> $d_id,
								'design_owner_id'	=> design_owner($d_id),
								'qty'				=> $total_qty,
								'price'				=> $record['design_price'],
								'total'				=> $record['total']* $total_qty,
								'created'			=> date('Y-m-d')
								);
							$this->db->insert('design_sales', $data);
							$total_sold_qty = $this->design_sold_qty($d_id);
							$total_sold_qty += $total_qty;
							$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
					}		
				}
		}

		/*
		$products_designs = $this->session->userdata('products_designs');

		foreach ($products_designs as $prod_de) {	

			$design_owner = design_owner($prod_de['design_id']);
			$data = array(
					'order_id'			=> $order_table_id,
					'product_id'		=> $prod_de['product_id'],
					'design_id'			=> $prod_de['design_id'],
					'design_owner_id'	=> $design_owner,
					'qty'				=> $prod_de['qty'],
					'price'				=> $prod_de['design_price'],
					'total'				=> $prod_de['total'],
					'created'			=> date('Y-m-d')
				);

			$this->db->insert('design_sales', $data);
			$total_sold_qty = $this->design_sold_qty($prod_de['design_id']);
			$total_sold_qty += $prod_de['qty'];
			$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $prod_de['design_id']));
		}

		if ($this->session->userdata('products_designs')) {
			$this->session->set_userdata('products_designs', '');
			$this->session->unset_userdata('products_designs');
		}
		*/

		/*if ($this->session->userdata('design_array')) {
			$products_designs = $this->session->userdata('design_array');
			$item_array = array();
			$products_designs = $this->session->userdata('design_array');
			foreach ($products_designs as $row_id => $prod_ids) {
				foreach ($prod_ids as $prod_id => $designs) {
					foreach ($designs as $d_id => $record) {
						if (isset($item_array[$prod_id][$d_id])) {
							$item_array[$prod_id][$d_id]['qty'] += $record['qty'];
							$item_array[$prod_id][$d_id]['total'] += $record['total'];
						} else {
							$item_array[$prod_id][$d_id] = $record;
						}
					}
				}
			}

			foreach ($item_array as $prod_id => $designs) {
				foreach ($designs as $d_id => $record) {
					$design_owner = design_owner($record['design_id']);
					$total_qty = $record['qty'] * $record['design_qty'];
					$data = array(
							'order_id'			=> $order_table_id,
							'product_id'		=> $prod_id,
							'design_id'			=> $d_id,
							'design_owner_id'	=> design_owner($d_id),
							'qty'				=> $total_qty,
							'price'				=> $record['design_price'],
							'total'				=> $record['total'],
							'created'			=> date('Y-m-d')
						);
					$this->db->insert('design_sales', $data);
					$total_sold_qty = $this->design_sold_qty($d_id);
					$total_sold_qty += $total_qty;
					$this->update('design', array('total_sold_qty' => $total_sold_qty), array('id' => $d_id));
				}
			}

			if ($this->session->userdata('design_array')) {
				$this->session->set_userdata('design_array', '');
				$this->session->unset_userdata('design_array');
			}

			/*if ($this->session->userdata('design_array1')) {
				$this->session->set_userdata('design_array1', '');
				$this->session->unset_userdata('design_array1');
			}
		}*/

		$this->session->set_userdata('discount','');
        $this->session->unset_userdata('discount');
        $this->session->set_userdata('grand_total','');
        $this->session->unset_userdata('grand_total');

		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Shirtscore Order';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'Shirtscore.com');	// From email in array form
		$to = array(
			 $cart_user_info['email']
		);

		// $html = "<h3> Your Order ID is <br> $order_id </h3> <br>";
		// $html .= "<h3> Your Order Tracking Link is <br> ".base_url()."store/order_tracking/".$order_id." </h3> <br>";
		$html = $this->template_for_purchasing_design($order_id);
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
		$this->session->set_userdata('first_product ','');
        	$this->session->unset_userdata('first_product ');
        	$this->session->set_userdata('cart_user_info','');
        	$this->session->unset_userdata('cart_user_info');
        	
		return $order_id;
	}

	public function template_for_purchasing_design($order_id){
	    $data['order_id'] = $order_id;
	    $data['template'] = 'email/design_registration_template';
	    $message = $this->load->view('templates/email_template',$data,TRUE);
	    return $message; 
	}

	public function get_order_status($order_id='')
	{
		
		$this->db->select('order_status');
		$this->db->where('order_id', $order_id);	
		$query = $this->db->get('orders');
		if($query->num_rows() == 1)
			return $query->row()->order_status;
		else
			return FALSE;
	}


	public function order_tracking($order_id='')
	{
		$oid = 0;
		$this->db->select('id');
		$this->db->where('order_id', $order_id);	
		$query = $this->db->get('orders');
		if($query->num_rows() == 1)
			$oid = $query->row()->id;
		else
			return FALSE;

		$this->db->select('od.gross_amount, od.total_amount, od.tax_amount, od.payment_method, od.payment_status, od.order_status, od.created, item.product_id, item.quantity, item.price, item.subtotal, item.cart_detail');
		$this->db->from('orders as od');
		$this->db->where('od.id', $oid);
		$this->db->join('order_items as item', 'od.id = item.order_id');
		$query = $this->db->get();
		//print_r($query->rad2deg(number)esult()); die();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	public function order_user_info($order_id){
		$this->db->select('orders.*, buyers.recipient_name, buyers.email, buyers.delivery_address, buyers.shipping_city2, buyers.shipping_state2, buyers.country, buyers.shipping_zip2,buyers.say_something,buyers.is_gift ');
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

	public function get_design_price($design_id = 0){
		$this->db->select('price');	
		$this->db->where('id',$design_id);		
		$query=$this->db->get('design');
		if($query->num_rows()>0)
			return $query->row()->price;
		else
			return FALSE;
	}

	public function get_discount($code="")
	{
		// echo "Code = ".$code;
		// $coupon = $this->get_row('coupons', array('code' => $code));
		// if ($co) {
		// 	# code...
		// }
		$this->db->where('start_date <=', date('Y-m-d'));
		$this->db->where('end_date >=', date('Y-m-d'));
		$this->db->where('status', 1);
		$this->db->where('code', $code);
		$query=$this->db->get('coupons');
		// print_r($query->row());
		// die();
		if($query->num_rows()>0){
			if ($query->row()->discount_use == 1 && $query->row()->num_uses > 0) {
				$error = 'Coupon is a single use. And already used.';
				return array('status' => 'error', 'msg' => $error);
			}else{
				$used_count = ($query->row()->num_uses + 1);
				$this->update('coupons', array('num_uses' => $used_count), array('code' => $code));
				return array('status' => 'success', 'resp' => $query->row());
			}
		}
		else
			return array('status' => 'error', 'msg' => 'Invalid/Expired Code.');
	}

	// public function designss($limit, $offset){

	//     if(isset($_GET['category']) && !empty($_GET['category'])){
	// 		$category_slug=trim($_GET['category']);
	// 		if(!empty($category_slug)){	
	// 			$category=$this->get_row('design_category',array('slug'=>$category_slug));			
	// 			$category_id = $category->id;
	// 			if ($value = $this->get_result('design', array('status'=>1))){				
	// 				$arr = array();
	// 				foreach ($value as $key){	
	// 					$cats = unserialize($key->category);
	// 					if(in_array($category_id, $cats)){
	// 						$arr []= $key->id;
	// 					}
	// 				}
	// 			}

	// 			if (!empty($arr)){ 
	// 				$this->db->where_in('id', $arr);
	// 			}
	// 		}			
	// 	}

		
	// 	if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
	// 		$sort_by=trim($_GET['sort_by']);
	// 		if($sort_by==='newest') $this->db->order_by('id','desc');

	// 		if($sort_by==='best-selling') $this->db->order_by('total_sold_qty','desc');
					
	// 		if($sort_by==='most-liked') $this->db->order_by('fb_like_count','desc');		
			
	// 	}

	// 	if(isset($_GET['search']) && !empty($_GET['search'])){
	// 		$search=trim($_GET['search']);
	// 		$this->db->like('design_title',$search);
	// 		$this->db->or_like('description',$search);
	// 	}	

	// 	$this->db->where('status',1);
		
	// 	if($limit > 0 && $offset>=0){
	// 		$this->db->limit($limit, $offset);						
	// 		$query=$this->db->get('design');
	// 		if($query->num_rows()>0)
	// 			return $query->result();
	// 		else
	// 			return FALSE;
	// 	}else{									
	// 		$query=$this->db->get('design');
	// 		return $query->num_rows();
	// 	}
	// }

	public function my_products($limit, $offset){

		$arr = array();
	    if(isset($_GET['category']) && !empty($_GET['category'])){
			$category_slug=trim($_GET['category']);
			if(!empty($category_slug)){	
				$category=$this->get_row('design_category',array('slug'=>$category_slug));
				$category_id = $category->id;
				if ($value = $this->get_result('products', array('admin_custom'=>1))){				
					
					foreach ($value as $key){	
						$cats = unserialize($key->category_id);
						if(in_array($category_id, $cats)){
							$arr []= $key->id;
						}
					}
					if (empty($arr))
						return FALSE;
				}
			}
		}

		$this->db->select('prod.*');
		$this->db->from('products as prod');
		$this->db->where_in('prod.custom_product_status', 1);
		$this->db->where_in('prod.admin_custom', 1);
		if (!empty($arr))
			$this->db->where_in('prod.id', $arr);
		
		if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
			$sort_by=trim($_GET['sort_by']);
			if($sort_by==='newest') $this->db->order_by('prod.id','desc');
		}
       
		if(isset($_GET['search']) && !empty($_GET['search'])){
			$search=trim($_GET['search']);
			$this->db->like('prod.regular_name',$search);
			$this->db->or_like('prod.desc',$search);
		}

		$this->db->where('prod.admin_custom',1);

		if($this->session->userdata('my_store')){
			$store = $this->session->userdata('my_store');
			// $this->db->join('design_to_multistore as st_dsn','dsn.id=st_dsn.design_id');	
			$this->db->where('prod.store_id', $store->id);
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

	public function designss($limit, $offset, $sort, $cat, $keyword){

		$arr = array();
	    if($cat != '-' && !empty($cat)){
			$category=$this->get_row('design_category',array('slug'=>$cat));
			if ($category) {
				$category_id = $category->id;
				if ($value = $this->get_result('design', array('status'=>1))){
					foreach ($value as $key){	
						$cats = unserialize($key->category);
						if(in_array($category_id, $cats)){
							$arr []= $key->id;
						}
					}
					if (empty($arr))
						return FALSE;
				}
			}
		}

		$this->db->select('dsn.*');
		$this->db->from('design as dsn');

		if (!empty($arr))
			$this->db->where_in('dsn.id', $arr);

		if(!empty($sort)){

			if($sort=='newest') $this->db->order_by('dsn.id','desc');

			if($sort=='best-selling') { $this->db->order_by('dsn.total_sold_qty','desc');}

			if($sort=='most-liked') {$this->db->order_by('dsn.fb_like_count','desc');}	

		}else{
			$this->db->order_by('dsn.id','desc');
		}


       
		if($keyword != '-' && !empty($keyword)){
			$this->db->like('dsn.design_title',$keyword);
			$this->db->or_like('dsn.description',$keyword);
		}

		$this->db->where('dsn.status',1);

		if($this->session->userdata('my_store')){
			$store = $this->session->userdata('my_store');
			$this->db->join('design_to_multistore as st_dsn','dsn.id=st_dsn.design_id');	
			$this->db->where('st_dsn.store_id', $store->id);
		}

		if($limit > 0 && $offset>=0){
			if($keyword == '-' || empty($keyword))
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

	// public function designss($limit, $offset){

	// 	$arr = array();
	//     if(isset($_GET['category']) && !empty($_GET['category'])){
	// 		$category_slug=trim($_GET['category']);
	// 		if(!empty($category_slug)){	
	// 			$category=$this->get_row('design_category',array('slug'=>$category_slug));
	// 			if ($category) {
	// 				$category_id = $category->id;
	// 				if ($value = $this->get_result('design', array('status'=>1))){				
						
	// 					foreach ($value as $key){	
	// 						$cats = unserialize($key->category);
	// 						if(in_array($category_id, $cats)){
	// 							$arr []= $key->id;
	// 						}
	// 					}
	// 					if (empty($arr))
	// 						return FALSE;
	// 				}
	// 			}
	// 		}
	// 	}

	// 	$this->db->select('dsn.*');
	// 	$this->db->from('design as dsn');

	// 	if (!empty($arr))
	// 		$this->db->where_in('dsn.id', $arr);
		
	// 	if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
	// 		$sort_by=trim($_GET['sort_by']);
	// 		if($sort_by==='newest') $this->db->order_by('dsn.id','desc');

	// 		if($sort_by==='best-selling') $this->db->order_by('dsn.total_sold_qty','desc');

	// 		if($sort_by==='most-liked') $this->db->order_by('dsn.fb_like_count','desc');		

	// 	}else{
	// 		$this->db->order_by('dsn.fb_like_count','desc');
	// 	}
       
	// 	if(isset($_GET['search']) && !empty($_GET['search'])){
	// 		$search=trim($_GET['search']);
	// 		$this->db->like('dsn.design_title',$search);
	// 		$this->db->or_like('dsn.description',$search);
	// 	}

	// 	$this->db->where('dsn.status',1);

	// 	if($this->session->userdata('my_store')){
	// 		$store = $this->session->userdata('my_store');
	// 		$this->db->join('design_to_multistore as st_dsn','dsn.id=st_dsn.design_id');	
	// 		$this->db->where('st_dsn.store_id', $store->id);
	// 	}

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

	public function get_all_design_your_own($uniqid=''){
		// echo "here"; die();
		$this->db->select('dyo.id as dyo_id, dyo.uniqid, dyo.user_id, dyo.product_id, dyo.design_id, dyo.new_design_image, dyo.status,p.*');
		$this->db->from('design_your_own as dyo');		
		$this->db->join('products as p','p.id=dyo.product_id');	
		$this->db->where('dyo.uniqid',$uniqid);		
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_all_design_for_your_own($design_id =''){
		$this->db->select('price');	
		$this->db->where_in('id',$design_id);		
		$query=$this->db->get('design');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_limited_result($table_name='', $id_array='', $limit){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$this->db->order_by('total_sold_qty', 'DESC');

		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function admins_stores($limit, $offset){		
		$this->db->select('users.firstname,users.lastname,stores.*');
		$this->db->order_by('stores.id', 'desc');
		$this->db->where('stores.status', 1);
		$this->db->where('stores.is_blocked', 0);
		$this->db->where('users.user_role !=', 0);
		$this->db->from('stores');
		$this->db->join('users','users.id=stores.user_id');
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$query=$this->db->get();
			if($query->num_rows()>0){
				return $query->result();
			}
			else
				return FALSE;
		}else{
			$query=$this->db->get();
			return $query->num_rows();
		}
	}

	// public function designss($limit, $offset, $sort, $cat, $keyword){

	// 	$arr = array();
	//     if($cat != '-' && !empty($cat)){
	// 		$category=$this->get_row('design_category',array('slug'=>$cat));
	// 		if ($category) {
	// 			$category_id = $category->id;
	// 			if ($value = $this->get_result('design', array('status'=>1))){
	// 				foreach ($value as $key){	
	// 					$cats = unserialize($key->category);
	// 					if(in_array($category_id, $cats)){
	// 						$arr []= $key->id;
	// 					}
	// 				}
	// 				if (empty($arr))
	// 					return FALSE;
	// 			}
	// 		}
	// 	}

	// 	$this->db->select('dsn.*');
	// 	$this->db->from('design as dsn');

	// 	if (!empty($arr))
	// 		$this->db->where_in('dsn.id', $arr);
		
	// 	if(!empty($sort)){
	// 		if($sort==='newest') $this->db->order_by('dsn.id','desc');

	// 		if($sort==='best-selling') $this->db->order_by('dsn.total_sold_qty','desc');

	// 		if($sort==='most-liked') $this->db->order_by('dsn.fb_like_count','desc');		

	// 	}else{
	// 		$this->db->order_by('dsn.fb_like_count','desc');
	// 	}
       
	// 	if($keyword != '-' && !empty($keyword)){
	// 		$this->db->like('dsn.design_title',$keyword);
	// 		$this->db->or_like('dsn.description',$keyword);
	// 	}

	// 	$this->db->where('dsn.status',1);

	// 	if($this->session->userdata('my_store')){
	// 		$store = $this->session->userdata('my_store');
	// 		$this->db->join('design_to_multistore as st_dsn','dsn.id=st_dsn.design_id');	
	// 		$this->db->where('st_dsn.store_id', $store->id);
	// 	}

	// 	if($limit > 0 && $offset>=0){
	// 		if($keyword == '-' || empty($keyword))
	// 			$this->db->limit($limit, $offset);	
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

	public function available_products($limit, $offset, $sort, $cat, $keyword){

		$arr = array();
	    if($cat != '-' && !empty($cat)){
			$category=$this->get_row('design_category',array('slug'=>$cat));
			if ($category) {
				$category_id = $category->id;
				if ($value = $this->get_result('products', array('product_status'=>1,'is_customized'=>0))){
					foreach ($value as $key){	
						$cats = unserialize($key->category);
						if(in_array($category_id, $cats)){
							$arr []= $key->id;
						}
					}
					if (empty($arr))
						return FALSE;
				}
			}
		}

		if (!empty($arr))
			$this->db->where_in('id', $arr);

		if(!empty($sort)){
			if($sort==='newest') $this->db->order_by('id','desc');

			if($sort==='best-selling') $this->db->order_by('sold_qty','desc');		

		}else{
			$this->db->order_by('id','desc');
		}
       
		if($keyword != '-' && !empty($keyword)){
			$this->db->like('regular_name',$keyword);
			$this->db->or_like('desc',$keyword);
		}

		$this->db->where('product_status', '1');
		$this->db->where('is_customized', '0');
		// $this->db->where('admin_custom', '0');
		// $this->db->where('custom_product_status', '0');
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

	public function check_info($uid=0)
	{
		$this->db->where('id', $uid);
		$this->db->where('firstname !=', '');
		$this->db->where('lastname !=', '');
		$this->db->where('email !=', '');
		$this->db->where('address !=', '');
		$this->db->where('city !=', '');
		$this->db->where('state !=', '');
		$this->db->where('country !=', '');
		$this->db->where('zip !=', '');
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
			return TRUE;
		else
			return FALSE;
	}
	public function get_result_desings($slug=''){

		$this->db->where('status', 1);
		$this->db->where_not_in('slug', $slug);
		$query2 = $this->db->get('design'); 
		if($query2->num_rows()>0)
		return $query2->result();
		else
		return FALSE;
		}

public function store_home_dashboard(){

		$uid = storeadmin_id();
		$this->db->from('stores');
		$this->db->where('user_id',customer_id());
		$this->db->where('status', 0);
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

public function wear_it_product()
	{
		$this->db->from('products');
		$this->db->where('product_status',1);
		$this->db->where('custom_product_status',0);
		$this->db->order_by('order','asc');
		$this->db->limit('20');
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function wear_it_single_product($product_id='')
	{

		$this->db->from('products');
		$this->db->where('product_status',1);
		$this->db->where('custom_product_status',0);
		if($product_id==0)
		{
			$this->db->order_by('id','desc');
		}
		else
		{
			$this->db->where('id',$product_id);
		}
		
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

		public function get_prod_image_color($color_id = ''){
		$this->db->select('main_image');
		$this->db->from('product_colors');
		$this->db->where('id', $color_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->main_image;
		else
			return FALSE;
	}

	public function get_design_ajax($design_id=''){		
		$this->db->where('status',1);
		$this->db->where('show_on_editor',1);
		$where='"'.$design_id.'"';
		$this->db->like('category',$where);
		$query=$this->db->get('design');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function filter_category($store_id='')
	{	
		$this->db->select('design.category');
		$this->db->join('design_to_multistore','design_to_multistore.design_id=design.id');
		$this->db->where('design_to_multistore.store_id',$store_id);
		$this->db->where('design.status',1);
		$query=$this->db->get('design');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function filter_category_multi($unique)
	{
		$unique_arr=explode(',', $unique);
		$this->db->where_in('id',$unique_arr);
		$query=$this->db->get('design_category');
		if($query->num_rows()>0)

			return $query->result();
		else
			return FALSE;
	}
public function insert_last_record($id)
	{
		 $query=$this->db->query('INSERT INTO `products`(`slug`, `category`, `store_id`, `sold_qty`, `main_image`, `back_image`, `default_color`, `restricted_para`, `image_url`, `size_id`, `group_id`, `prefix`, `regular_name`, `short_name`, `singular`, `uri`, `sizechart`, `is_sizechart`, `price`, `name`, `desc`, `designer`, `product_status`, `custom_product_status`, `product_used`, `is_customized`, `is_purchased`, `admin_custom`, `is_custom_uploaded`, `front_upload_image`, `back_upload_image`, `created`, `modified`)select `slug`, `category`, `store_id`, `sold_qty`, `main_image`, `back_image`, `default_color`, `restricted_para`, `image_url`, `size_id`, `group_id`, `prefix`, `regular_name`, `short_name`, `singular`, `uri`, `sizechart`, `is_sizechart`, `price`, `name`, `desc`, `designer`, `product_status`, `custom_product_status`, `product_used`, `is_customized`, `is_purchased`, `admin_custom`, `is_custom_uploaded`, `front_upload_image`, `back_upload_image`, `created`, `modified` from products where id='.$id);
			return $this->db->insert_id(); 
		
	}
}/* End of file store_model.php */
