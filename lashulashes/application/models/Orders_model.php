<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function orders_product($offset = '', $per_page = '') 
    {
        $this->db->from('orders');

        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            $this->db->group_start();
                $this->db->like('order_id',$_GET['search']);
                //$this->db->or_like('a.booking_id',$_GET['search']);
            $this->db->group_end();
        }

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->select('orders.*,(select concat(users.first_name," ",users.last_name)  from users where users.id = orders.user_id) as user_name, (select users.email from users where users.id = orders.user_id) as user_email, (select users.mobile  from users where users.id = orders.user_id) as user_phone');
            $this->db->limit($per_page, $offset);
            $this->db->order_by('order_id', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }
        else 
        {
            return $this->db->count_all_results();
        }
    }

    public function orders_services($offset = '', $per_page = '', $user_id = 0) 
    {
        
        $this->db->from('services_bookings as a');
        $this->db->join('services_bookings as b','a.id=b.booking_id');
        $this->db->distinct();

        if(!empty($user_id))
        {
            $this->db->where('a.client_id',$user_id);
        }

        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            $this->db->group_start();
                $this->db->like('a.email',trim($_GET['search']));
                $this->db->or_like('a.registration_id',trim($_GET['search']));
            $this->db->group_end();
        }

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->select('a.*');
            $this->db->limit($per_page, $offset);
            $this->db->order_by('a.booking_id','desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }
        else 
        {
            $this->db->select('a.*');
            return $this->db->count_all_results();
        }
    }
    public function orders_training($offset = '', $per_page = '', $user_id = 0) 
    {
        //method-1
        $this->db->from('training_booking as a');
        $this->db->join('training_booking as b','a.id=b.booking_id');
        $this->db->distinct();

        //method-2
        // $this->db->from('training_booking as a');
        // $this->db->group_by('a.booking_id');

        if(!empty($user_id))
        {
            $this->db->where('a.client_id',$user_id);
        }

        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            $this->db->group_start();
                $this->db->like('a.email',trim($_GET['search']));
                $this->db->or_like('a.registration_id',trim($_GET['search']));
            $this->db->group_end();
        }

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->select('a.*');
            $this->db->limit($per_page, $offset);
            $this->db->order_by('a.booking_id','desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }
        else 
        {
            $this->db->select('a.*');
            return $this->db->count_all_results();
        }
    }



}