<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Products_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();

    }

    public function products($offset = '', $per_page = '') 
    {
        $this->db->from('products');

        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            $this->db->group_start();
                $this->db->like('title',$_GET['search']);
            $this->db->group_end();
        }


        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->select('products.*,(select AVG(rating.rating) from rating where rating.product_id=products.id && rating.status=1 ) as avg_rating,(select count(rating.rating_id) from rating where rating.product_id=products.id && rating.status=0 ) as new_rating');
            $this->db->limit($per_page, $offset);
            $this->db->order_by('order', 'asc');
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

    public function rating_list($product_id,$offset = '', $per_page = '') 
    {        
        $this->db->select('rt.*,u.first_name,u.last_name,u.image');
        $this->db->from('rating as rt');
        $this->db->where('product_id',$product_id);
        $this->db->join('users as u','u.id=rt.user_id');

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->limit($per_page, $offset);
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

    /*
    Frontend  methods start
    */

    public function product_list($offset =0,$per_page ='',$category='')
    {        
        $this->db->from('products as p');
        $this->db->where('p.status',1);
        $this->db->join('product_category as pc','pc.id=p.category_id');
        $this->db->where('pc.status',1);

        if(!empty($category))
        {
            $this->db->where('p.category_id',$category);
        }
        if(isset($_GET['price'])&& !empty($_GET['price']))
        {
            $this->db->order_by('p.price',$_GET['price']);
        }
        if(isset($_GET['title'])&& !empty($_GET['title']))
        {
            $this->db->order_by('p.title',$_GET['title']);
        }
        else
        {
            $this->db->order_by('p.order','ASC');
        }

        if($offset>=0 && $per_page>0)
        {
            $this->db->select('p.*,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image,(select AVG(rating.rating) from rating where rating.product_id=p.id && rating.status=1 ) as avg_rating');
            //$this->db->order_by('p.id','desc');
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

    public function featured_product_list($offset =0,$per_page ='')
    {

        
        $this->db->from('products as p');
        $this->db->where('p.status',1);
        $this->db->join('product_category as pc','pc.id=p.category_id');
        $this->db->where('pc.status',1);
        $this->db->where('p.best',1);

        if(isset($_GET['price'])&& !empty($_GET['price']))
        {
            $this->db->order_by('p.price',$_GET['price']);
        }
        if(isset($_GET['title'])&& !empty($_GET['title']))
        {
            $this->db->order_by('p.title',$_GET['title']);
        }

        if($offset>=0 && $per_page>0)
        {
            $this->db->select('p.*,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image,(select AVG(rating.rating) from rating where rating.product_id=p.id && rating.status=1 ) as avg_rating');
            $this->db->order_by('p.id','desc');
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

    //public function best_product_list()
    public function product_list_fix_category($type='',$limit='')
    {
        if(!empty($type))
        {
            $this->db->where('p.'.$type,1);
        }

        if(!empty($limit))
        {
            $this->db->limit($limit);
        }

        $this->db->from('products as p');
        $this->db->where('p.status',1);
        $this->db->join('product_category as pc','pc.id=p.category_id');
        $this->db->where('pc.status',1);

        $this->db->select('p.*,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image,(select AVG(rating.rating) from rating where rating.product_id=p.id && rating.status=1 ) as avg_rating');
        $this->db->order_by('p.id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
           return $query->result();
        else
            return FALSE;
    }

    //single product with first/front image by product id
    public function single_product($productid = 0)
    {
        $this->db->from('products as p');
        $this->db->where('p.id',$productid);

        $this->db->select('p.*,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image');
        $this->db->order_by('p.id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
           return $query->row();
        else
            return FALSE;
    }

    //single product with first/front image by product slug
    public function single_product_by_slug($slug = '')
    {
        $this->db->from('products as p');
        $this->db->where('p.slug',$slug);

        $this->db->select('p.*,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image');
        $this->db->order_by('p.id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
           return $query->row();
        else
            return FALSE;
    }

    //retrn detail in json
    public function product_attribute_details($id=0)
    {
        $detail = $this->Common_model->get_row('product_attribute_details',array('id'=>$id));
        if(!$detail) 
        {
             return FALSE;
        }
        else
        {
            if(!empty($detail->attribute_key) && !empty($detail->variation_key))
            {
                $result =array();
                $variation_list = $this->Common_model->get_in_array('product_configure_terms','id',json_decode($detail->variation_key));
                if(!$variation_list) $variation_list = array();

                $attribute_list = $this->Common_model->get_in_array('product_attributes','id',json_decode($detail->attribute_key));
                if(!$attribute_list) $attribute_list = array();
                $temp=array();
                foreach ($attribute_list as $row) 
                {
                   $temp[] = array($row->id,$row->attribute); 
                }
                $result[] = $temp;
                $temp=array();
                foreach ($variation_list as $row) 
                {
                   $temp[] = array($row->id,$row->name); 
                }
                $result[] = $temp;

                $result = json_encode($result,JSON_PRETTY_PRINT);
                return $result;
            }
            else
            {
                return FALSE;
            }
        }
    }


    //get list of rating by product id.
    public function get_product_ratings($product_id=0)
    {
        $this->db->select('rt.*,u.first_name,u.last_name,u.image');
        $this->db->from('rating as rt');
        $this->db->where('rt.status',1);
        $this->db->where('product_id',$product_id);
        $this->db->join('users as u','u.id=rt.user_id');

        $query = $this->db->get();
        if($query->num_rows()>0)
           return $query->result();
        else
            return FALSE;        

    }

    public function favorites_list($offset = '', $per_page = '') 
    {        
        $this->db->from('products as p');
        $this->db->select('p.*,f.fav_id,(select pi.thumb from product_image as pi where pi.product_id = p.id && pi.active=1) as active_image,(select pi.thumb from product_image as pi where pi.product_id = p.id limit 1) as first_image');
        $this->db->join('my_favorites as f','f.product_id=p.id');
        $this->db->where('f.user_id',user_id());
        $this->db->where('p.status',1);

        if ($offset >= 0 && $per_page > 0) 
        {
            $this->db->limit($per_page, $offset);
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