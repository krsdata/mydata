<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Api_model extends CI_Model {

		public function insert($table_name='',  $data=''){
			$query=$this->db->insert($table_name, $data);
			if($query)
				return  $this->db->insert_id();
			else
				return FALSE;		
		}

		public function get_result($table_name='', $id_array=''){
			if(!empty($id_array)):		
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
				}
			endif;

			$query=$this->db->get($table_name);
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}

		public function get_row($table_name='', $id_array=''){
			if(!empty($id_array)):		
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
				}
			endif;

			$query=$this->db->get($table_name);
			if($query->num_rows()>0)
				return $query->row();
			else
				return FALSE;
		}


		public function update($table_name='', $data='', $id_array=''){
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}		
			return $this->db->update($table_name, $data);
		}

		public function delete($table_name='', $id_array=''){		
			return $this->db->delete($table_name, $id_array);
		}

		public function themes($limit, $offset){				
			if($limit > 0 && $offset>=0){
				$this->db->limit($limit, $offset);			
				$this->db->order_by('id', 'desc');		
				$query=$this->db->get('themes');
				if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
			}else{
				$query=$this->db->get('themes');
				return $query->num_rows();
			}
		}

		public function images($theme_id=''){				
			$this->db->select('image,sound');		
			$this->db->where('theme_id',$theme_id);
			$query=$this->db->get('images');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
			
		}
	
}/* End of file superadmin_model.php */
