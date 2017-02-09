<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Services_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function categories($offset='',$per_page='') 
    {

        $this->db->from('services_category');
        $this->db->where('parent_id',0);

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->limit($per_page, $offset);
            $this->db->order_by('orders','ASC');
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

    public function services($offset = '', $per_page = '') 
    {

        $this->db->from('posts');
        $this->db->where('post_type','services');
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

    public function time_range($offset = '', $per_page = '') 
    {

        $this->db->from('services_timing');
        if ($offset >= 0 && $per_page > 0) {
            $this->db->limit($per_page, $offset);
            //$this->db->order_by('id', 'desc');
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

    //backend method for check leave condition if num row > 0 bookings are available

    public function check_booking_for_leave($artist_id, $book_date, $time_from, $time_to)
    {
        /*  SELECT * FROM `services_bookings` WHERE (`time_from` < 1000) AND (`time_to` > 0800) */

        $this->db->from('services_bookings');

        $this->db->where('artist_id',$artist_id);
        $this->db->where('book_date',$book_date);
        
        $this->db->where('time_from <',$time_to);
        $this->db->where('time_to >',$time_from);
        
        /*$this->db->where('time_from <',$time_to);
        $this->db->where('time_to <',$time_to);*/

        $query = $this->db->get();
        if($query->num_rows() > 0)
            return TRUE;
        else
           return FALSE;

    }

    public function getArtistWeekDaysLeave($artist_id){
        if(isset($artist_id)&&!empty($artist_id)){
            $sql    = " SELECT of.artist_id, a.name, a.timing, of.off_type, of.date AS leave_on, of.time_from, of.time_to
                        FROM  services_artist a
                        LEFT JOIN services_artist_offs of ON of.artist_id = a.id AND of.off_type = 1
                        WHERE a.id = $artist_id "; 
            $query  =   $this->db->query($sql); 
            if ($query->num_rows() > 0) 
                    return $query->result(); 
        }
        return FALSE;
    }

    public function getArtistDaysServicesTime($artist_id){
        if(isset($artist_id)&&!empty($artist_id)){
            $sql    = " SELECT sum(((MOD(time_to,100)*60)+((time_to/100)*3600)) - ((MOD(time_from,100)*60)+((time_from/100)*3600))) AS remaing_sec,
                               book_date
                        FROM `services_bookings`
                        WHERE artist_id = 4
                        GROUP BY book_date "; 
            $query  =   $this->db->query($sql); 
            if ($query->num_rows() > 0) 
                    return $query->result(); 
        }
        return FALSE;
    }

    public function getCategoryData($cat=array()){
        if(count($cat)>0){
            $sql    = " SELECT name
                        FROM `services_category`
                        WHERE id IN (".implode(',',$cat).") "; 
            $query  =   $this->db->query($sql); 
            if ($query->num_rows() > 0) 
                    return $query->result(); 
        }
        return FALSE;
    }



}