<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Traning_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function traning($offset = '', $per_page = '') 
    {
        $this->db->select('t.*,(select tc.name from traning_category as tc where tc.id=t.category_id) as name');
        $this->db->from('traning as t');
        //$this->db->join('traning_category as tc','tc.id=t.category_id');
        if(isset($_GET['search']) && !empty($_GET['search']))
        {  
            $search = trim($_GET['search']);              
            $this->db->like('t.title',$search);
        }

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->limit($per_page, $offset);
            $this->db->order_by('t.start_date', 'desc');
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
    
    public function get_training_row($id='')
    {
        $time = date('Y-m-d',time());
        $this->db->select('t.*,tc.name');
        $this->db->from('traning as t');
        $this->db->where('t.id',$id);
        $this->db->join('traning_category as tc','tc.id=t.category_id');
        $this->db->where('t.start_date>',$time);
        $this->db->where('t.status',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }

    public function get_act_training($offset = '', $per_page = '') 
    {
        $time = date('Y-m-d',time());
        $this->db->select('t.*,tc.name');
        $this->db->from('traning as t');
        $this->db->join('traning_category as tc','tc.id=t.category_id');
        $this->db->where('t.start_date>',$time);
        $this->db->where('t.status',1);
        $this->db->order_by('t.start_date', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return FALSE;
    }

    public function get_selected_training() 
    {
        
        $time = date('Y-m-d',time());

        $this->db->select('t.*,tc.name');
        $this->db->from('traning as t');
        $this->db->join('traning_category as tc','tc.id=t.category_id');
        $this->db->where('t.status',1);
        $this->db->where('t.start_date >',$time);

        if(isset($_GET['month']) && !empty($_GET['month']))
        {                
            $this->db->like('t.start_date',$_GET['month'],'after');
        }

        if(isset($_GET['location']) && !empty($_GET['location']))
        {                
            $this->db->where('t.state',$_GET['location']);
        }
        if(isset($_GET['category']) && !empty($_GET['category']))
        {                
            $temp = strtolower($_GET['category']);
            $temp_training_array = array('bronze'=>1,'silver'=>2,'gold'=>3,'platinum'=>4);
            if(isset($temp_training_array[$temp]))
            {
                $this->db->where('t.category_id',$temp_training_array[$temp]);
            }
        }

        $this->db->order_by('t.start_date', 'asc');
        /*$this->db->group_start();
                $this->db->where('t.start_date >=',$year.'-'.$month_start.'-1');
                $this->db->where('t.start_date <=',$year.'-'.$month_end.'-'.$day);
                $this->db->where('t.start_date >=',$time);
        $this->db->group_end();*/
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return FALSE;
    }



}