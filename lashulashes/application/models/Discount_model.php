<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Discount_model extends CI_Model{



    public function __construct()
    {
        parent::__construct();
    }

    public function discount($offset = '', $per_page = '') 
    {
        $this->db->select("plan_discount_code.*,  CONCAT(users.first_name,' ',users.last_name) as name ,users.email, plans.title as plan_name");
        $this->db->from('plan_discount_code');   
        $this->db->join('users', 'users.id = plan_discount_code.user_id','left');
        $this->db->join('plans', 'plans.id = plan_discount_code.plan_id','left');
        
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $this->db->group_start();
            $this->db->like('discount_code',$_GET['search']);
            $this->db->or_like('plans.title',$_GET['search']);
            $this->db->or_like("CONCAT(users.first_name,' ',users.last_name)",$_GET['search']);
            $this->db->or_like('users.email',$_GET['search']);
            $this->db->group_end();
        }

        if ($offset >= 0 && $per_page > 0){
            $this->db->limit($per_page, $offset);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            if($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }else{
            return $this->db->count_all_results();
        }
    }

    public function get_membership_order($offset = '', $per_page = '') 
    {
        $this->db->select("users_plans_detail.*,  CONCAT(users_plans_detail.first_name,' ',users_plans_detail.last_name) as user_name , plans.title as plan_name_title");
        $this->db->from('users_plans_detail');   
        $this->db->join('plans', 'plans.id = users_plans_detail.plan_id','left');
        
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $this->db->group_start();
            $this->db->like('users_plans_detail.first_name',$_GET['search']);
            $this->db->or_like('users_plans_detail.last_name',$_GET['search']);
            $this->db->or_like('users_plans_detail.email_address',$_GET['search']);
            $this->db->or_like('users_plans_detail.membership_order_id',$_GET['search']);
            $this->db->or_like('plans.title',$_GET['search']);
            $this->db->group_end();
        }

        if ($offset >= 0 && $per_page > 0){
            $this->db->limit($per_page, $offset);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            if($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }else{
            return $this->db->count_all_results();
        }
    }

    public function get_user_plan_details($user_id){
        $this->db->select("plan_discount_code.*,  CONCAT(users.first_name,' ',users.last_name) as name , plans.title as plan_name");
        $this->db->from('plan_discount_code');   
        $this->db->join('users', 'users.id = plan_discount_code.user_id','left');
        $this->db->join('plans', 'plans.id = plan_discount_code.plan_id','left');
        $this->db->where('plan_discount_code.user_id',$user_id);
        //$this->db->where('is_used',1);
        $this->db->order_by('plan_discount_code.id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows() > 0)
            return $query->row();
        else
           return FALSE;
    }

    public function validate_discount_code($str){
       
        $this->db->select("plan_discount_code.*");
        $this->db->from('plan_discount_code');   
        $this->db->where('discount_code',$str);
        $this->db->where('is_used',0);
        //$this->db->where('start_date >=', $current_date);
       // $this->db->where('end_date <=', $current_date);   
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows() > 0)
            return $query->row();
        else
           return array();
    }



}