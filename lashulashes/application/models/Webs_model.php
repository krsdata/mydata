<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Webs_model extends CI_Model{



    public function __construct()

    {
        parent::__construct();

    }

    public function blogs($offset=0,$per_page =0,$type=0,$slug=0) {
              

        $this->db->from('blogs');
         if($type=='tag')
         {
         $this->db->where('blog_tag',$slug); 
         }
         if($type=='category')
         {
            $query=$this->db->query("SELECT id FROM  blog_category Where category_slug='".$slug."'");
            $catid=$query->result(); 
             if(isset($catid[0]->id))
             {
              $this->db->where('blog_categoryid',$catid[0]->id); 
             }
         }       
        if ($offset >= 0 && $per_page > 0) {

            $this->db->limit($per_page, $offset);
            $this->db->order_by('blog_id', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)

                return $query->result();
            else

               return FALSE;



        }else {



            return $this->db->count_all_results();



        }



    }


      public function news($offset = '', $per_page = '') {
       

        $this->db->from('posts');        
        $this->db->where('post_type','news'); 
        $this->db->where('status',1); 
          
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



     public function category_count(){

        $query=$this->db->query("SELECT category_name,category_slug,count(blog_categoryid) as num_rows from  blogs JOIN blog_category ON blog_category.id=blogs.blog_categoryid Where blog_status=1 AND status=1");

        return $query->result();

    }


    public function get_plan_order_details($order_id){
        $this->db->select("users_plans_detail.*,  plans.title , plans.image");
        $this->db->from('users_plans_detail');   
        $this->db->join('plans', 'plans.id = users_plans_detail.plan_id','left');
        $this->db->where('users_plans_detail.id',$order_id);
        //$this->db->where('is_used',1);

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows() > 0)
            return $query->row();
        else
           return FALSE;
    }





}