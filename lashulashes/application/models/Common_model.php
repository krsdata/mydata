<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
    public function insert($table_name = '', $data = '')
    {
        $query = $this->db->insert($table_name, $data);
        if ($query) return $this->db->insert_id();
        else return FALSE;
    }

    public function get_result($table_name = '', $id_array = '', $columns = array(), $order_by = array(),$limit='')

    {

        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        if(!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        if (!empty($limit)):
            $this->db->limit($limit);
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }

    public function get_result_array($table_name = '', $id_array = '', $columns = array(), $order_by = array(),$limit='')

    {

        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        if(!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        if (!empty($limit)):
            $this->db->limit($limit);
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result_array();
        else return FALSE;
    }

    public function get_row($table_name = '', $id_array = '', $columns = array(), $order_by = array())
    {
        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        if(!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $this->db->get($table_name);
        if($query->num_rows()>0) return $query->row();
        else return FALSE;
    }

    public function update($table_name = '', $data = '', $id_array = '')
    {
        if(!empty($id_array)):
            foreach($id_array as $key => $value){
                $this->db->where($key, $value);
            }
        endif;
        return $this->db->update($table_name, $data);
    }

    public function delete($table_name = '', $id_array = '')
    {
        return $this->db->delete($table_name, $id_array);
    }


    public function getColumnDataWhere($table,$column='',$where='',$orderby='',$ordertype='')
    {
        if($column !='')
        {
            $this->db->select($column);
        }
        else
        {
            $this->db->select('*');
        }   
        $this->db->from($table);
        if($where !='')
        {
            $this->db->where($where);
        }
        if($orderby !='')
        {
            $this->db->order_by($orderby,'ASC');
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function page($slug=''){
        
        if(!empty($slug)){
            $query = $this->db->get_where('posts',array('post_slug'=>$slug,'post_type'=>'page', 'status'=>'1'));
            if($query->num_rows()>0)
                return $query->row();
            else
                return FALSE;
        }else{
            return FALSE;
        }
    } 

    public function get_in_array($table_name = '',$in_column='', $in_array = array(),$con_array='')
    {
        if(empty($in_array))
            return FALSE;

        /*if(!empty($in_array) && !empty($in_column)):*/
            $this->db->where_in($in_column, $in_array);
        /*endif;*/

        if(!empty($con_array)):
            foreach ($con_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }

    public function get_result_pagination($tablename,$offset =0,$per_page ='',$condition=array(),$orderby='')
    {

        $this->db->from($tablename);
        if(!empty($condition))
        {
            foreach ($condition as $key => $value) 
            {
                $this->db->where($key, $value);
            }
        }
        
        if(!empty($orderby))
        {
           $this->db->order_by($orderby[0],$orderby[1]);
        }


        if($offset>=0 && $per_page>0)
        {
            $this->db->limit($per_page,$offset);
            $query = $this->db->get();
            if($query->num_rows()>0)
               return $query->result();
            else
                return FALSE;
        }
        else
        {
            return $this->db->count_all_results();
        }
    }

    public function get_aus_state()
    {
        $this->db->from('australia_cities');
        $this->db->group_by('state_code');
        $query = $this->db->get();
        if($query->num_rows()>0)
           return $query->result();
        else
            return FALSE;
    }


}

