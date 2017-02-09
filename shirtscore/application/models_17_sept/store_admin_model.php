<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_admin_model extends CI_Model {

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
		//return $query->row()->order_id;
	}

	public function stores($limit, $offset){	
		$this->db->order_by('id', 'desc');							
		$this->db->where('user_id',storeadmin_id());		
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$query=$this->db->get('stores');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$query=$this->db->get('stores');
			return $query->num_rows();
		}
	}

	public function get_store($id){				
		$this->db->where('id', $id);	
		$query=$this->db->get('stores');
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

	public function users($limit, $offset, $store_id){
		$this->db->select('us.id, us.firstname, us.lastname');
		$this->db->from('users as us');
		$this->db->where('byr.is_registered', 1);		
		$this->db->where('od.store_id', $store_id);		
		$this->db->join('buyers as byr', 'us.id = byr.user_id');
		$this->db->join('orders as od', 'byr.id = od.buyer_id');
		$this->db->group_by('us.id');
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$this->db->order_by('us.id', 'desc');			
			$query=$this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->order_by('us.id', 'desc');			
			$query=$this->db->get();
			return $query->num_rows();
		}
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

	public function my_query($limit, $offset){	
		$admin = $this->session->userdata('storeadmin_info');		
		$this->db->limit($limit, $offset);
		$this->db->where('admin_id', $admin['id']);
		$this->db->order_by('id', 'desc');		
		if($limit > 0 && $offset>=0){					
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

	public function products($limit, $offset){	
		$info = $this->session->userdata('storeadmin_info');
		$admin_id = $info['id'];
		$store_arr = get_store_ids($admin_id);
		$stores_id=array();
		foreach ($store_arr as $row) {
			$stores_id[]=$row->id;
		}
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);			
			$this->db->order_by('id', 'desc');			
			if(is_array($stores_id))
				$this->db->where_in('products.store_id', $stores_id);			
			$query=$this->db->get('products');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			if(is_array($stores_id))
				$this->db->where_in('products.store_id', $stores_id);		
			$query=$this->db->get('products');
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

	public function get_product($product_id){
		$this->db->select('p.*, grp.group_name, s.store_name');
		$this->db->from('products as p');
		$this->db->where('p.id', $product_id);		
		$this->db->join('product_group as grp', 'grp.id = p.group_id');
		$this->db->join('stores as s', 's.id = p.store_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

	public function get_products_categories($cat_ids){
		$this->db->select('cat.id, cat.category_name');
		$this->db->from('product_category as cat');
		$this->db->where_in('cat.id', $cat_ids);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
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

	public function get_colors($product_id){
		$this->db->select('c.color_code,pi.image_name,pi.color_id,pi.view');
		$this->db->from('product_colors as c');
		$this->db->where('c.product_id', $product_id);
		$this->db->join('product_images as pi', 'c.id = pi.color_id');
		$query = $this->db->get();
		return $query->result();
	}


	public function display_products($limit, $offset, $type, $month="", $year=""){	

		$info = $this->session->userdata('storeadmin_info');
		$admin_id = $info['id'];
		$store_arr = get_store_ids($admin_id);
		$this->db->where('admin_custom', 1);
		$this->db->where('product_status', 0);
		$this->db->where('is_customized', 0);
		$this->db->order_by('id', 'desc');
		if($type == "month"){
			$this->db->like('created', date('Y-m', strtotime($month.' '.$year)));
		}elseif($type == "year"){
			// echo "here".$year; die();

			$this->db->like('created', $year);
		}
		$stores_id=array();
		foreach ($store_arr as $row) {
			$stores_id[]=$row->id;
		}
		if(is_array($stores_id))
		$this->db->where_in('products.store_id', $stores_id);
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

	public function categories($limit, $offset){				
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);			
			$this->db->order_by('id', 'desc');			
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

	public function colors($product_id){				
			$this->db->order_by('id', 'desc');	
			$this->db->where('product_id', $product_id);				
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

	public function get_product_info($order_id)
	{
		$this->db->select('product_id,parameter_id,color_id');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('order_items');
		$product = array();
		foreach ($query->result() as $row){
			$this->db->select('p.*,pp.*,cat.category_name,pi.image_name,c.color_code');
			$this->db->from('products as p');
			$this->db->where('p.id', $row->product_id);
			$this->db->where('pp.id', $row->parameter_id);
			$this->db->where('c.id', $row->color_id);
			$this->db->join('product_colors as c', 'p.id = c.product_id');
			$this->db->join('product_images as pi' , 'p.id = pi.product_id');
			$this->db->join('product_category as cat', 'p.category_id = cat.id');
			$this->db->join('product_parameters as pp', 'p.id = pp.product_id');
			$this->db->group_by('p.id');
			$result1 = $this->db->get();			
			$product[]=$result1->result();
		}
		return $product;
	}


	public function faqs($limit, $offset, $user_id){				
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);	
			$this->db->where('user_id', $user_id);		
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

	public function store_home(){

		$uid = storeadmin_id();
		$this->db->select('us.firstname, us.lastname, st.store_name,st.store_description, st.store_link, st.store_banner,st.status');
		$this->db->from('users as us');
		$this->db->where('us.id', $uid);
		$this->db->join('stores as st', 'st.user_id = us.id');		
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
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

	public function dashboard_report($uid){
		$data = array();
		$this->db->select_sum('total_sold_qty');
		$this->db->where('artist_id', $uid);
		$query=$this->db->get('design');
		if($query->num_rows()>0)
			$data['total_sold'] = $query->row()->total_sold_qty;
		else
			$data['total_sold'] = 0;

		$this->db->select_sum('qty');
		$this->db->where('design_owner_id', $uid);
		$this->db->where('payment_status', 0);
		$query=$this->db->get('design_sales');
		if($query->num_rows()>0)
			$data['total_earned'] = ($query->row()->qty * commission_rate());
		else
			$data['total_earned'] = 0;

		// echo "Unpaid = ".$data['total_earned'];
		// die();
		$this->db->select('id');
		$this->db->where('artist_id', $uid);
		$this->db->where('status', 0);
		$query=$this->db->get('design');
		$data['total_pending'] = $query->num_rows();

		$this->db->select('total_paid_com');
		$this->db->where('user_id', $uid);
		$query=$this->db->get('commission_request');
		if($query->num_rows()>0){
			$data['total_com'] = $query->row()->total_paid_com;
		}
		else{
			$data['total_com'] = 0;
		}

		return $data;
	}

	public function store_orders($store_id, $uid)
	{
		$this->db->select('od.id as order_id');
		$this->db->from('buyers as byr');
		$this->db->where('byr.is_registered', 1);		
		$this->db->where('od.store_id', $store_id);
		$this->db->where('byr.user_id', $uid);
		$this->db->join('orders as od', 'byr.id = od.buyer_id');
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function user_purcahses($orders)
	{
		
		$this->db->select('dsn_s.*, dgn.id,dgn.design_title, dgn.design_image');
		$this->db->from('design_sales as dsn_s');
		$this->db->where_in('dsn_s.order_id', $orders);
		// $this->db->join('orders as od','od.id=dsn_s.order_id');			
		$this->db->join('design as dgn','dgn.id=dsn_s.design_id');
		$this->db->order_by('dsn_s.order_id', 'desc');
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

	public function get_user_profile($user_id = ''){
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

	// public function design_info($design_id = 0)
	// {
	// 	if ($design_id == 0) {
	// 		return FALSE;
	// 	}

	// 	$this->db->select('dsn.*, SUM(dsn_s.qty) as total_qty, ');
	// 	$this->db->from('design as dsn');
	// 	$this->db->where('dsn.id', $design_id);	
	// 	// $this->db->where('user_role',3);
	// 	$this->db->join('design_sales as dsn_s','dsn.id=dsn_s.design_id');
	// 	if($query->num_rows()>0)
	// 		return $query->result();
	// 	else
	// 		return FALSE;
	// }

	public function get_design_categories($categories='')
	{
		if (empty($categories)) {
			return FALSE;
		}
		$categories = unserialize($categories);

		$this->db->select('category_name');
		$this->db->where_in('id', $categories);
		$query=$this->db->get('design_category');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_selected_design_to_multistore($design_id=''){
		$this->db->select('store_id');
		$this->db->where('design_id', $design_id);
		$query=$this->db->get('design_to_multistore');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;		
	}

	public function my_stores(){
		$uid = storeadmin_id();
		$this->db->select('st.id, st.store_name, st.store_description, st.store_link, st.store_banner');
		$this->db->from('users as us');
		$this->db->where('us.id', $uid);
		$this->db->where('st.status', 1);
		$this->db->where('st.is_blocked', 0);
		$this->db->where('st.is_processed', 1);
		$this->db->join('stores as st', 'st.user_id = us.id');		
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function custom_product_sizes($size_ids=''){
		$this->db->select('size_name');
		$this->db->order_by('id', 'desc');
		$this->db->where_in('id', $size_ids);
		$query=$this->db->get('product_sizes');
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

	public function messages($limit, $offset){
		$this->db->where('admin_id', storeadmin_id());
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

public function store_home_dashboard(){

		$uid = storeadmin_id();
		$this->db->from('stores');
		$this->db->where('user_id', $uid);
		$query=$this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function count_store_design($id)
	{
		$this->db->select('count(id) as count');
		$this->db->where('design_id', $id);
		$query=$this->db->get('design_to_multistore');
		return $query->row();
	}
}/* End of file store admin_model.php */
