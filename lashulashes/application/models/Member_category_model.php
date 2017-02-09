<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class member_category_model extends CI_Model{



    public function __construct()

    {

        parent::__construct();


    }

    public function member_category($offset = '', $per_page = '') {

        $this->db->from('membership_category');
        
        
        if ($offset >= 0 && $per_page > 0) {

            $this->db->limit($per_page, $offset);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)

                return $query->result();
            else

               return FALSE;



        }else {



            return $this->db->count_all_results();



        }



    }



}