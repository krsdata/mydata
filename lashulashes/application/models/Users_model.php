<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function users($offset = '', $per_page = '') 
    {
        $this->db->from('users');
        $this->db->where('user_role',1);
        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            $this->db->group_start();
                $this->db->like('email',$_GET['search']);
                $this->db->or_like('first_name',$_GET['search']);
            $this->db->group_end();
        }
        if ($offset >= 0 && $per_page > 0) {
            $this->db->limit($per_page, $offset);
            $this->db->order_by('id', 'desc');
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



}