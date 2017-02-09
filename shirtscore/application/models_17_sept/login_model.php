<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table_name	= 'users';			// user table name
	private	 $profile_table_name = 'user_profiles';	// user profiles table name
		
	function login($username=null, $password, $user_role=null, $super_login='') {	
		if(strpos($username,'@')===FALSE)			
			$this->db->where('username', $username);
		else 
			$this->db->where('email', $username);				
		
		if ($super_login != '')
			$this->db->where('password', $password);
		else
			$this->db->where('password', sha1($password));

		$this->db->where('user_role', $user_role);
		$query=$this->db->from($this->table_name);			
		$query=$this->db->get();

		if($user_role==3){

			// echo "here"; die();

			if ($query->num_rows()==1) {			
				if($query->row()->banned==1){
					$msg['error_msg']='Account has banned yet.';				
					$msg['status']=FALSE;
					return $msg;
				}
				else{
					$row=array(
						'id'=>$query->row()->id,
						'user_role'=>$query->row()->user_role,
						'username'=>$query->row()->username,					
						'firstname'=>$query->row()->firstname,
						'lastname'=>$query->row()->lastname,
						'email'=>$query->row()->email,
						'last_ip'=>$query->row()->last_ip,
						'last_login'=>$query->row()->last_login,
						'is_storeadmin'=>$query->row()->is_storeadmin,				
						'logged_in'=>TRUE,
						'created'=> $query->row()->created
						);	

					if($query->row()->is_storeadmin == 1){
						$this->session->set_userdata('storeadmin_info', $row);
					}
					$this->session->set_userdata('customer_info',$row);
					$this->update_login_info($query->row()->id, $record_ip=TRUE, $record_time=TRUE);

					$msg['is_storeadmin'] = $query->row()->is_storeadmin;				
					$msg['error_msg']='Okk.';				
					$msg['status']=TRUE;
					return $msg;
				}	
			}else{				
				$msg['error_msg']='Invalid username and password.';				
				$msg['status']=FALSE;
				return $msg;
				}
				
		}else{
			// echo "there"; die();
			if ($query->num_rows()==1) {

				if($query->row()->banned==1){
					//return 'USERBANNED';
					$msg['error_msg']='Account has banned yet.';				
					$msg['status']=FALSE;
					return $msg;
				}else if($query->row()->activated==0){
					//echo "yes";	
					$msg['error_msg']='Account not activated yet.';				
					$msg['status']=FALSE;
					return $msg;
				}else{
					$row=array(
						'id'=>$query->row()->id,
						'user_role'=>$query->row()->user_role,
						'username'=>$query->row()->username,					
						'firstname'=>$query->row()->firstname,
						'lastname'=>$query->row()->lastname,
						'email'=>$query->row()->email,
						'last_ip'=>$query->row()->last_ip,
						'last_login'=>$query->row()->last_login,				
						'logged_in'=>TRUE
						);	
					if($user_role==0){
						$user_sess_name='superadmin_info';
					}else if($user_role==1){
						$user_sess_name='customerservices_info';
					}
					$this->session->set_userdata($user_sess_name,$row);
					
					$this->update_login_info($query->row()->id, $record_ip=TRUE, $record_time=TRUE);			
					$msg['status']=TRUE;
					return $msg;
				}	
			}else{			
				//return 'INVALIDUSER';
				$msg['error_msg']='Invalid username and password.';				
				$msg['status']=FALSE;
				return $msg;
			}
		}
	}


	function fb_login($uid=0) {

		$this->db->where('id', $uid);
		$this->db->where('activated', 1);
		$this->db->where('banned', 0);
		$query=$this->db->from($this->table_name);			
		$query=$this->db->get();

		if ($query->num_rows() == 1) {
			if($query->row()->banned == 1){
				$msg['error_msg'] = 'Account has banned yet.';
				$msg['status'] = FALSE;
				return $msg;
			}else{
				$row=array(
					'id'=>$query->row()->id,
					'user_role'=>$query->row()->user_role,
					'username'=>$query->row()->username,
					'firstname'=>$query->row()->firstname,
					'lastname'=>$query->row()->lastname,
					'email'=>$query->row()->email,
					'last_ip'=>$query->row()->last_ip,
					'last_login'=>$query->row()->last_login,
					'is_storeadmin'=>$query->row()->is_storeadmin,
					'logged_in'=>TRUE,
					'created'=> $query->row()->created
					);

				if($query->row()->is_storeadmin == 1){
					$this->session->set_userdata('storeadmin_info', $row);
				}
				$this->session->set_userdata('customer_info',$row);
				$this->update_login_info($query->row()->id, $record_ip=TRUE, $record_time=TRUE);

				$msg['is_storeadmin'] = $query->row()->is_storeadmin;
				$msg['error_msg']='Okk.';
				$msg['status']=TRUE;
				return $msg;
			}
		}else{
			$msg['error_msg']='Invalid user.';
			$msg['status']=FALSE;
			return $msg;
			}
	}


	function is_email_available($email)	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	function create_user($data, $activated = TRUE) {
		$data['created'] = date('Y-m-d H:i:s');
		$data['activated'] = $activated ? 1 : 0;

		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			if ($activated)	$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
		return NULL;
	}



	function activate_user($user_id, $activation_key, $activate_by_email){
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {
			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name);

			$this->create_profile($user_id);			
			return TRUE;
		}
		return FALSE;
	}

	


	function update_login_info($user_id, $record_ip, $record_time) {
		
		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));

		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}


	function ban_user($user_id, $reason = NULL) {
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	function unban_user($user_id) {
		$this->db->where('id', $user_id);
		$this->db->update('users', array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	function set_password_key($user_id, $new_pass_key) {
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function can_reset_password($user_id, $new_pass_key, $expire_period = 900) {
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}


	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900) {
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}
	

	function change_password($user_id, $new_pass) {
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function delete_user($user_id) {
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}
	private function create_profile($user_id) {
		$this->db->set('user_id', $user_id);
		return $this->db->insert($this->profile_table_name);
	}
	
	private function delete_profile($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->profile_table_name);
	}

}