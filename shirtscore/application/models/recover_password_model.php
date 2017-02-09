<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recover_password_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

    function get_row($table_name='', $id_array=''){
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

  function check_email($email, $secret_key){
      $query = $this->db->get_where('users', array('email' => $email));
      if($query->num_rows() > 0){
          $this->db->where('id', $query->row()->id);
          $this->db->update('users', array('secret_key' => $secret_key));
          return $query->row()->id;
      }
      else{
        $this->session->set_flashdata('error', 'Email not found, Cannot proceed.');
        redirect('recover_password/forget_password');
      }
    }
 function check_secret_key($secret_key){
      $this->db->where('secret_key', $secret_key);
      $query = $this->db->get('users');
      if($query->num_rows() == 1)
        return TRUE;
      else
        return FALSE;
  }
  function update_password($data, $secret_key){
      $this->db->where('secret_key', $secret_key);
      $query = $this->db->get('users');
      $this->db->where('secret_key', $secret_key);
      $this->db->update('users', $data);
      return $query->row()->user_role;
  }

  function check_storeadmin_email($email, $secret_key){
      $query = $this->db->get_where('users', array('email' => $email));
      if($query->num_rows() > 0){
          $this->db->where('id', $query->row()->id);
          $this->db->update('users', array('secret_key' => $secret_key));
          return $query->row()->id;
      }
      else{
        $this->session->set_flashdata('error', 'Email not found, Cannot proceed.');
        redirect('recover_password/forget_password_store');
      }
    }



}