<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blogs_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }


    public function insert($table_name = '', $data = '') 
    {
        $query = $this->db->insert($table_name, $data);
        if($query) return $this->db->insert_id();
        else return FALSE;
    }

    public function get_result($table_name = '', $id_array = '', $columns = array(), $order_by = array())
    {
        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;

        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }


    public function get_row($table_name = '', $id_array = '', $columns = array())
    {
        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;

        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->row();
        else return FALSE;
    }


    public function update($table_name = '', $data = '', $id_array = '')
    {
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        return $this->db->update($table_name, $data);
    }

    public function delete($table_name = '', $id_array = '')
    {
        return $this->db->delete($table_name, $id_array);
    }


    public function blogs($offset = '', $per_page = '') 
    {

        $this->db->select('blogs.*,(select category_name from blog_category where blog_category.category_slug=blogs.blog_categoryid) as category_name,(select count(blog_comment.id) from blog_comment where blog_comment.blog_id = blogs.blog_id ) as comment_count');
        $this->db->from('blogs');
        // $this->db->join('blog_category','blogs.blog_categoryid=blog_category.id');
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

    public function comment_list($offset = '', $per_page = '',$blog_id=0) 
    {
            $this->db->select('bc.*,u.first_name,u.last_name, u.image');
            $this->db->from('blog_comment as bc');
            $this->db->join('users as u','u.id=bc.user_id');
            $this->db->where('bc.blog_id',$blog_id);
        if ($offset >= 0 && $per_page > 0) 
        {

            $this->db->limit($per_page, $offset);
            $this->db->order_by('blog_id', 'desc');
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

    /*front-end methods*/

    public function blog_view($slug)
    {
            $this->db->select('b.*,(select bc.category_name from blog_category as bc where bc.category_slug=b.blog_categoryid) as category_name');
            $this->db->from('blogs as b');
            $this->db->where('b.blog_status',1);
            $this->db->where('b.blog_slug',$slug);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->row();
            else
                return FALSE;
    }

    public function comment($blog_id)
    {
            $this->db->select('bc.*,u.first_name,u.last_name, u.image');
            $this->db->from('blog_comment as bc');
            $this->db->join('users as u','u.id=bc.user_id'); 
            $this->db->where('bc.blog_id',$blog_id);
            $this->db->where('bc.status',1);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
    }

    public function blog_list($offset = '',$per_page = '',$type='',$get='') 
    {
        $this->db->select('b.*');
        $this->db->from('blogs as b');
        $this->db->where('blog_status',1);
        $this->db->order_by('b.blog_created','desc');

        if($type=='tag'&& !empty($get))
        {
            $this->db->like('b.blog_tag',$get);
        }

        if($type=='cat'&& !empty($get))
        {
            $this->db->where('b.blog_categoryid',$get);
        }
            
        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->limit($per_page,$offset);
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