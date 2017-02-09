<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        clear_cache();

        $this->load->model('user_model');
        //$this->output->enable_profiler(TRUE);

        $this->load->library('session');  //Load the Session
    }

    private function check_login(){
        if (storeadmin_info())
            return FALSE;
        else
            return customer_login_in();
    }

    public function index(){
        $this->dashboard();
    }

    public function dashboard($offset=0){
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }
        $uid = customer_id();
        $data['messages']=$this->user_model->get_result('messages', array('status' => 0, 'admin_id' => $uid));
        $limit=20;
        $data['pending_designs'] = $this->user_model->pending_designs($uid, $limit, $offset);
        $config1 = get_pagination_style();
        $config1['base_url'] = base_url().'user/dashboard/';
        $config1['total_rows'] = $this->user_model->pending_designs($uid, 0, 0);
        $data['pendings_count'] =  $config1['total_rows'];
        $config1['uri_segment'] = 3;
        $config1['per_page'] = $limit;
        $config1['num_links'] = 5;
        $this->pagination->initialize($config1);
        $data['pagination'] = $this->pagination->create_links();
        
       
        $data['template'] = 'user/dashboard';
        $this->load->view('templates/user_template', $data);    
    }


    public function register(){     
        if($_POST){
            $status=$this->user_model->check_email($this->input->post('email'));
            if($status===TRUE){
                echo "Email alredy exist.";
            }else{
                $fname = $this->input->post('firstname');
                $lname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user_data=array(
                    'firstname'=>ucfirst($this->input->post('firstname')),
                    'lastname'=>ucfirst($this->input->post('lastname')),
                    'gender'=>$this->input->post('gender'),
                    'email'=>trim($this->input->post('email')),
                    'password'=>sha1(trim($this->input->post('password'))),
                    'username'=>$this->input->post('username'),
                    'newsletter'=>$this->input->post('newsletter'),
                    'created'=> date('Y-m-d')
                    );

                $status=$this->user_model->insert('users',$user_data);
                $this->send_registration_email($fname, $lname, $email, $password);
                if($status===FALSE){ 
                    echo "ERROR."; 
                }else{
                    $this->load->model('acapellahq_model');             
                    $status=$this->acapellahq_model->login(trim($email),trim($password),3);
                    
                    if($status['status']){
                        echo '1';       
                    }else{
                        echo $status['error_msg'];
                    }   
                }
            }
        }
    }

    public function send_registration_email($fname, $lname, $email, $password){
        $this->load->library('smtp_lib/smtp_email');
        $subject = 'Bayts User';    // Subject for email
        $from = array('no-reply@bayts.com' =>'Bayts.com');  // From email in array form
        $to = array(
             $email,
        );
        $html = $this->template_for_resgistration($fname, $lname, $email, $password);
        $is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
    }
    public function template_for_resgistration($fname, $lname, $email, $password){
        $message = '';
        $message .= '<html>
                        <body>
                        <h3>Hello '.$fname." ".$lname.',</h3><h4>Your Account has been successfully created. You can login with the following credentials<br> Email : '.$email.'<br> Password : '.$password.' </h4>';
        
        $message .= '</table></body></html>';

        return $message;
    }

    public function login(){        
        if($_POST){
             $email = $this->input->post('email');
             $password = $this->input->post('password');
             $redirect_url = $this->input->post('redirect_url');

            $this->load->model('acapellahq_model');             
            $status=$this->acapellahq_model->login($email,$password,3); 
            if($status['status']){
                echo '1';               
            }else{
                echo $status['error_msg'];
            }
        }
    }

   public function logout(){
        $this->session->set_userdata('customer_info','');
        $this->session->unset_userdata('customer_info');
        $this->session->unset_userdata('storeadmin_info');
        $this->session->set_flashdata('success_msg', "logout successfully");
        redirect('store/login');
    }

    public function dashboard_designs($paging='',$offset=0){
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }
        $uid = customer_id();
        if ($paging == 'pendings') {
           $offset1 = $offset;
           $offset2 = 0;
        }else{
           $offset1 = 0;
           $offset2 = $offset;
        }

        $limit=6;
        $data['pending_designs'] = $this->user_model->pending_designs($uid, $limit, $offset1);
        $config1 = get_pagination_style();
        $config1['base_url'] = base_url().'user/dashboard_designs/pendings/';
        $config1['total_rows'] = $this->user_model->pending_designs($uid, 0, 0);
        $data['pendings_count'] =  $config1['total_rows'];
        $config1['uri_segment'] = 4;
        $config1['per_page'] = $limit;
        $config1['num_links'] = 5;
        $this->pagination->initialize($config1);
        $data['pagination_pending'] = $this->pagination->create_links();

        $data['approved_designs'] = $this->user_model->approved_designs($uid, $limit, $offset2);
        $config2 = get_pagination_style();
        $config2['base_url'] = base_url().'user/dashboard_designs/approved/';
        $config2['total_rows'] = $this->user_model->approved_designs($uid, 0, 0);
        $data['approved_count'] =  $config2['total_rows'];
        $config2['uri_segment'] = 4;
        $config2['per_page'] = $limit;
        $config2['num_links'] = 5;
        $this->pagination->initialize($config2);
        $data['pagination_approved'] = $this->pagination->create_links();




        // $data['pending_designs'] = $this->user_model->get_result('design', array('artist_id' => $uid,'status' => 0));

        // $data['approved_designs'] = $this->user_model->get_result('design', array('artist_id' => $uid,'status' => 1));
        
        $data['template'] = 'user/dashboard_designs';
        $this->load->view('templates/user_template', $data);    
    } 
    

    public function dashboard_msgs(){
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }       
        $uid = customer_id();
        $data['pending_designs'] = $this->user_model->get_result('design', array('artist_id' => $uid,'status' => 0));

        $data['approved_designs'] = $this->user_model->get_result('design', array('artist_id' => $uid,'status' => 1));
        
        $data['template'] = 'user/dashboard_msgs';
        $this->load->view('templates/user_template', $data);    
    }

    public function check_password($old_pass, $prev_pass){
        if (sha1($old_pass) == $prev_pass){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_password', 'Password confirmation failed');
            return FALSE;
        }
    } 

    public function check_unique_email($new_email, $old_email){
        if ($new_email == $old_email){
            return TRUE;
        }else{
            $resp = $this->user_model->get_row('users', array('email' => $new_email));
            if ($resp){
                $this->form_validation->set_message('check_unique_email', 'Email alredy exist');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }

     public function user_profile(){
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }
        $uid = customer_id();
         $data['user'] = $this->user_model->get_row('users',array('id'=>$uid));
       //  print_r($data['user']);
        // die();
        if ($this->input->post('profile')) {
            $this->form_validation->set_rules('firstname', 'First name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$data['user']->email.']');              
            $this->form_validation->set_rules('lastname', 'Last name', 'required');
            //$this->form_validation->set_rules('mobile', 'Phone Number', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');        
      $this->form_validation->set_rules('state', 'State', 'required');        
      $this->form_validation->set_rules('address', 'Address', 'required');        
      $this->form_validation->set_rules('country', 'Country', 'required');        
      $this->form_validation->set_rules('zip', 'Zip', 'required|integer |exact_length[5]');
      $this->form_validation->set_rules('mobile', 'Phone no.', 'required');
            if ($this->input->post('new_pass') != ''){
                $this->form_validation->set_message('min_length', "Password must contain atleast 6 characters.");
                $this->form_validation->set_rules('old_pass', 'Old Password', 'required|callback_check_password['.$data['user']->password.']');
                $this->form_validation->set_rules('new_pass', 'New Password', 'required|min_length[6]');
            }
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');  
        }
        if ($this->input->post('payee')) {
            // echo "payee update";
            // die();
            //echo $this->input->post('payee');
            $this->form_validation->set_rules('payee', '', 'required');
            //$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            // $this->form_validation->set_rules('acc_holder', 'A/C Holder Name', 'required');
            // $this->form_validation->set_rules('acc_no', 'A/C number', 'required');
            // $this->form_validation->set_rules('acc_type', 'A/c Type', 'required');
            // $this->form_validation->set_rules('routing_no', 'Routing Number', 'required');
            // $this->form_validation->set_rules('is_paypal', 'Paypal User', 'required');
            if ($this->input->post('is_paypal') == 1) {
                //$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');//paypal_email
            }
        }
        
        
        if($this->form_validation->run() == TRUE){
            //die;
            if($this->input->post('profile')) {
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname'  => $this->input->post('lastname'),
                    'email'     => $this->input->post('email'),
                    'mobile'    => $this->input->post('mobile'),
                    'address'   => $this->input->post('address'),
                    'city'      => $this->input->post('city'),
                    'state'     => $this->input->post('state'),
                    'country'   => $this->input->post('country'),
                    'zip'     => $this->input->post('zip'),
                    'modified'  => date('Y-m-d')            
                );
                if ($this->input->post('new_pass') != '') {
                    $data['password'] = sha1($this->input->post('new_pass'));
                }
                $this->user_model->update('users', $data, array('id' => $uid));
            }

            if ($this->input->post('payee')) {
                $data1 = array(
                    'bank_name'     => $this->input->post('bank_name'),
                    'acc_holder'    => $this->input->post('acc_holder'),
                    'acc_no'        => $this->input->post('acc_no'),
                    'acc_type'      => $this->input->post('acc_type'),
                    'routing_no'    => $this->input->post('routing_no'),
                    'is_paypal'     => $this->input->post('is_paypal'),
                    'paypal_email'  => $this->input->post('paypal_email'),
                    'updated'       => date('Y-m-d')
                );
                // print_r($data1);
                // die();
                 $this->user_model->update('user_payee_info', $data1, array('user_id' => $uid));
            }
            $this->session->set_flashdata('success_msg', 'Profile has been updated successfully.');
            redirect(current_url());
        }

         $data['state']=$this->user_model->get_result('state');
        $data['template'] = 'user/customer_profile';
        $this->load->view('templates/user_template', $data);    
    }

    // public function user_profile(){
    //     $login = $this->check_login();
    //     if (!$login) {
    //         redirect("store/login");
    //     }
    //     $uid = customer_id();
    //     $data['user'] = $this->user_model->get_user_profile();
    //     // print_r($data['user']);
    //     // die();
    //     $this->form_validation->set_rules('firstname', 'First name', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$data['user']->email.']');              
    //     $this->form_validation->set_rules('lastname', 'Last name', 'required');
    //     $this->form_validation->set_rules('mobile', 'Phone Number', 'required');
    //     $this->form_validation->set_rules('city', 'City', 'required');              
    //     $this->form_validation->set_rules('state', 'State', 'required');                
    //     $this->form_validation->set_rules('address', 'Address', 'required');                
    //     $this->form_validation->set_rules('country', 'Country', 'required');                
    //     $this->form_validation->set_rules('zip', 'Zip', 'required');
    //     if ($this->input->post('new_pass') != ''){
    //         $this->form_validation->set_message('min_length', "Password must contain atleast 6 characters.");
    //         $this->form_validation->set_rules('old_pass', 'Old Password', 'required|callback_check_password['.$data['user']->password.']');
    //         $this->form_validation->set_rules('new_pass', 'New Password', 'required|min_length[6]');
    //     }

    //     if ($this->form_validation->run() == TRUE){
    //         // print_r($this->input->post());
    //         // die();
    //         $data = array(
    //             'firstname' => $this->input->post('firstname'),
    //             'lastname'  => $this->input->post('lastname'),
    //             'email'     => $this->input->post('email'),
    //             'mobile'    => $this->input->post('mobile'),
    //             'address'    => $this->input->post('address'),
    //             'city'    => $this->input->post('city'),
    //             'state'    => $this->input->post('state'),
    //             'country'    => $this->input->post('country'),
    //             'zip'    => $this->input->post('zip'),
    //             'modified'    => date('Y-m-d')            
    //         );
    //         if ($this->input->post('new_pass') != '') {
    //             $data['password'] = sha1($this->input->post('new_pass'));
    //         }
    //         $this->user_model->update('users', $data, array('id' => $uid));
    //         $this->session->set_flashdata('success_msg', 'Profile has been updated successfully.');
    //         redirect("user/user_profile");
    //     }

    //     $data['template'] = 'user/user_profile';
    //     $this->load->view('templates/store_template', $data);    
    // }


     public function supports($offset=0){
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }       
        $uid = customer_id();          
        $limit=5;
        $data['supports']=$this->user_model->my_query($limit,$offset);
        $config = get_pagination_style();
        $config['base_url'] = base_url().'user/supports/';
        $config['total_rows'] = $this->user_model->my_query(0,0);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);         
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'user/support';
        $this->load->view('templates/user_template', $data);    
    }

    public function delete_support($id){
        $this->check_login();
        $this->user_model->delete('supports',array('id'=>$id));       
        $this->user_model->delete('conversation',array('support_id'=>$id));       
        $this->session->set_flashdata('success_msg','query has been deleted successfully.');
        redirect('user/supports');
    }



    public function view_query($support_id=""){
        $this->check_login();
        if(empty($support_id)) redirect('user/supports');
        $data['info'] = customer_info();                    
        $data['results'] = $this->user_model->get_row('supports', array('id' => $support_id));
        // print_r( $data['results']);
        // die();
        $a_name = $data['info']['firstname']." ".$data['info']['lastname'];
        $user_id = $data['info']['id'];
        $user_email = $data['info']['email'];

        $this->form_validation->set_rules('reply', 'reply', 'required');
        if($this->form_validation->run() === TRUE){
            $update_data = array(
                'message'   => $this->input->post('reply'),
                'created'   => date('Y-m-d H:i:s'),
                'user_name' => $a_name,
                'user_id'   => $user_id,
                'email'     => $user_email,
                'support_id'=> $support_id
            );

            $name = $data['results']->name;
            $email = $data['results']->email;
            $s_subject = $data['results']->subject;
            $message = $this->input->post('reply');

            $is_tagged = $this->user_model->get_row('support_tags', array('support_id' => $support_id));

            if ($is_tagged) {
                $query = $this->user_model->get_row('users', array('id' => $is_tagged->cust_service_id));
                $reply_to =  $query->email;
            }else{
                $query = $this->user_model->get_row('users', array('user_role' => 0));
                $reply_to =  $query->email;
            }
            $this->send_reply_mail($reply_to, $name, $email,$s_subject,$message);  
            if ($is_tagged) {
                $this->user_model->insert('cs_conversation', $update_data);
                // $this->user_model->update('supports', array('cust_service_replied'=>0, 'superadmin_replied'=>0, 'user_replied'=>1),array('id'=>$support_id));
            }else{
                $this->user_model->insert('conversation', $update_data);
            }           
            $this->user_model->update('supports', array('cust_service_replied'=>0, 'superadmin_replied'=>0, 'user_replied'=>1),array('id'=>$support_id));
            $this->session->set_flashdata('success_msg',"Replied Successfully.");
            redirect(current_url(),'refresh');
        }
        $reply = $this->user_model->get_result('conversation', array('support_id'=>$support_id));    
        $reply2 = $this->user_model->get_result('cs_conversation', array('support_id'=>$support_id));

        if ($reply != FALSE && $reply2 != FALSE) { // Validating data records
            $result = array_merge($reply, $reply2); // Merge records array
            usort($result, array($this,'sortFunction')); // Sort Array in DESC
        }elseif($reply){
            $result = $reply;
            usort($result, array($this,'sortFunction'));
        }elseif($reply2){
            $result = $reply2;
            usort($result, array($this,'sortFunction'));
        }else
            $result = FALSE;
        $data['reply'] = $result;

        // if ($reply) {
        //     if ($reply2) {
        //         foreach ($reply2 as $rpl) {
        //             array_push($reply, $rpl);
        //         }
        //     }
        //     $data['reply'] = $reply;
        // }else
        //     $data['reply'] = $reply2;
      
        // $data['reply'] = $data['reply'];    

        $data['template'] = 'user/view_query';
        $this->load->view('templates/user_template', $data);
    }

    private function sortFunction( $a, $b ) {
        $d1 = strtotime($a->created);
        $d2 = strtotime($b->created);
        if ($d1 == $d2)
            return  0;
        elseif($d1 < $d2)
            return  -1;
        elseif($d1 > $d2)
            return  1;
    }

    public function send_reply_mail($reply_to, $name, $email,$s_subject,$message){
         $this->load->library('smtp_lib/smtp_email');
         $subject = 'Reply from '.$name;
         $from = array("no-reply@shirtscore.com" =>'shirtscore.com');
         $to = array(
                $reply_to,
         );
         $html = "<em><strong>Support Query</strong></em> <br>
                <p> Name -".$name."</p>
                <p> Email -".$email."</p>
                <p> Subject -".$s_subject."</p>
                <p> Message -".$message."</p>
                <br><br>";
        $is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
    }

    public function need_help(){

        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }
        $user = customer_info();                   
        $data['info'] = $this->user_model->get_row('users', array('id' => $user['id']));
        $name = $data['info']->firstname." ".$data['info']->lastname;           
        $email = $data['info']->email;
        $this->form_validation->set_rules('subject', 'Subject', 'required');      
        $this->form_validation->set_rules('question', 'question', 'required');      
        if($this->form_validation->run() === TRUE){         
            $support=array(
                    'name'=>$name,                  
                    'email'=>$email,                                        
                    'customer_id'=>$user['id'],                   
                    'subject'=>$this->input->post('subject'),           
                    'question'=>$this->input->post('question'),                             
                    'created'=>date('Y-m-d h:i:s'),         
                    );
            // print_r($support);
            // die();
            $last_id = $this->user_model->insert('supports',$support);
            $token=str_pad($last_id, 5, "0", STR_PAD_LEFT);                 
            $token_new= date('y').$token;
            $resp = $this->user_model->update('supports',array('token' => $token_new), array('id' => $last_id));
            if ($resp){             
                $subject = $this->input->post('subject');
                $message = $this->input->post('question');

                $this->sendmail_to_superadmin($token_new,$email,$name,$subject,$message);
                 $this->load->library('smtp_lib/smtp_email');
                 $subject = 'Successfully received query';                                     // Subject for email
                 $from = array("no-reply@shirtscore.com" =>'shirtscore.com');              // From email in array form

                 $to = array(
                        $email
                        );                                                                  // To email address in array form

                 // $html = "<em><strong>Hello</strong></em> <br>
                 //        <p>".$name." Thank you for contacting with us, <br> We have recieved your Query and we will respond back to you soon.</p>
                 //        <strong>Your Token no. :</strong> <strong>".$token_new."</strong><br><br>
                 // ";
                 $html = $this->template_need_help($name,$token_new);

                 $is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
                 // print_r($is_fail);
                 // die();
            } 
            $this->session->set_flashdata('success_msg', 'query Successfully submitted');
            redirect('user/supports');      
        }

        $data['template'] = 'user/need_help';
        $this->load->view('templates/user_template', $data);  
    }

    public function template_need_help($name,$token_new){
        $data['name'] = $name;
        $data['token_new'] = $token_new;
        $data['template'] = 'email/need_help_template';
        $message = $this->load->view('templates/email_template',$data,TRUE);
        return $message;
    }

    public function sendmail_to_superadmin($token_new,$email,$name,$subject1,$message){

        // echo "<br> Token = ".$token_new;
        // echo "<br> Email = ".$email;
        // echo "<br> Name = ".$name;
        // echo "<br> Sub = ".$subject1;
        // echo "<br> Msg = ".$message;
        $query = $this->user_model->get_row('users', array('user_role' => 0));
        $superadmin_email =  $query->email;
        // echo "<br> superadmin_email = ".$superadmin_email;
       
        $this->load->library('smtp_lib/smtp_email');
        $subject = $token_new;
        $from = array("no-reply@shirtscore.com" =>'shirtscore.com');
        $to = array(         
                $superadmin_email                               
        );                                 
        $html = "<em><strong>Support Query</strong></em> <br>
                <p> Name -".$name."</p>
                <p> Email -".$email."</p>
                <p> Subject -".$subject1."</p>
                <p> Message -".$message."</p>
                <strong>Token no. :</strong> <strong>".$token_new."</strong><br><br>";
        $this->smtp_email->sendEmail($from, $to, $subject, $html);
            
    }
     public function check_img_size($a,$called){
     
        if ($called == 'add') {
           if ($_FILES['designfile']['tmp_name'] == '') {
               $this->form_validation->set_message('check_img_size', 'Select an image design to upload.');
                return FALSE;
           }
        }else{
          if ($_FILES['designfile']['tmp_name'] == '')
              return TRUE; 
        }

            $image = getimagesize($_FILES['designfile']['tmp_name']);

            if ($image[0] < 600 || $image[0] < 600) {
                $this->form_validation->set_message('check_img_size', 'Oops! Your design image needs to be atleast 600 x 600 pixels.
                    Otherwise its too small to print on our products.');
               return FALSE;
            }
            else{
                return TRUE;
            }
    }

    public function check_design_categories($fields){  
        $type = gettype($fields);
        if ($type === 'NULL'){
            $this->form_validation->set_message('check_design_categories', 'Select atleast 1 category.');
            return FALSE;
        }else{
            if (count($fields) > 3 ){
            $this->form_validation->set_message('check_design_categories', 'select up to 3 categories only.');
            return FALSE;
            }else{
                return TRUE;
            }
        }
    }


    public function designs_thumb_file($file){

        $path='./assets/uploads/designs';
         if (!is_writable($path.'/')) {
            if (!chmod($path.'/', 0777)) {
                 echo "Cannot change the mode of file ($0777)";
                 exit;
            }
        }
        $config1['image_library'] = 'gd2';
        $config1['source_image']    = $path.'/'.$file;
        $config1['new_image']   = $path.'/thumbnail/'.$file;    
        // $config1['create_thumb'] = TRUE;
        $config1['quality'] = '100%';
        list($width, $height, $type, $attr) = getimagesize($config1['source_image']);
        $config1['width'] = 240;
        $config1['height']  = 240 ;

        if ($width < $height) {
            $cal=$width/$height;           
            $config1['width']=$config1['width']*$cal;
            }
        else
            {
            $cal=$height/$width;
            $config1['height']=$config1['height']*$cal;
            }
        $config1['maintain_ratio'] = TRUE;
        
        $this->load->library('image_lib', $config1);
        if ( ! $this->image_lib->resize()){
             echo $this->image_lib->display_errors();
             exit;
        }

        $this->image_lib->clear();    
    }

  public function add_design()

     { //$this->output->enable_profiler(TRUE);   
       $this->form_validation->set_rules('artist', 'Artist', 'required');    
       $this->form_validation->set_rules('design_title', 'Design title', 'required');    
       $this->form_validation->set_rules('description', 'Description', 'required');    
       $this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');
       $this->form_validation->set_rules('designfile', 'Design File', 'callback_check_img_size['."add".']'); 
        $this->form_validation->set_rules('slug', 'Title-slug', 'required|callback_check_dgn_slug['."add,slug".']');
         if(!empty($_FILES['upload_video']['name'])){
             $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
            
        }

          if($this->form_validation->run()==TRUE)
          {
           
           if($this->session->userdata('upload_video')!=''){

                $upload_video=$this->session->userdata('upload_video');
                $data['design_video'] = $upload_video['upload_video'];  
                $data['design_video_type']  = $this->input->post('design_video_type');
             
           } else if(!empty($_POST['design_video'])){
                $data['design_video'] = $this->input->post('design_video');
                $data['design_video_type']  = $this->input->post('design_video_type');
            }
                $data['artist'] = $this->input->post('artist');
                $data['artist_id'] = customer_id();
                $data['design_title'] = $this->input->post('design_title');
                $data['slug'] = $this->input->post('slug');
                $data['description'] = $this->input->post('description');
                $data['category'] = serialize($this->input->post('category'));
                $data['created'] = date('Y-m-d');
               
               if($_FILES['designfile']['name']!=''){
                $config['upload_path'] = './assets/uploads/designs';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('designfile')){
                      $this->session->set_flashdata('image_error'.$do_upload['error']);
                      redirect(current_url());
                      //redirect('superadmin/add_product/');
                    }else{
                        // echo " <br> Uploded";
                        $upload_data = $this->upload->data();   
                        $data['design_image']=$upload_data['file_name'];
                        $this->designs_thumb_file($data['design_image']);
                    }
               }else{
                $this->session->set_flashdata('error_msg', 'Please select an image to upload');
                redirect(current_url());
               }

         $this->user_model->insert('design',$data);
           if($this->session->userdata('upload_video')!=''):
                    $this->session->unset_userdata('upload_video');
                endif;
           $this->session->set_flashdata('success_msg',"Design has been added successfully.");
           redirect('user/dashboard_designs');
          }
         if ($this->input->post('category'))
            $data['category_arr'] = $this->input->post('category');
        $data['category']= $this->user_model->get_result('design_category');
        $data['template'] = 'user/add_design';
        $this->load->view('templates/user_template', $data);
     }

     function upload_video($str='')
     {
        if(!empty($_FILES['upload_video']['name'])):
       
            $param=array(
                'file_name' =>'upload_video',
                'upload_path'  => './assets/uploads/upload_video/',
                'allowed_types'=> 'flv|mp4',
                'encrypt_name' => TRUE,
                        );

                            $upload_file=upload_file($param);
                         
                            if($upload_file['STATUS']){
                                if($this->session->userdata('upload_video')=='')
                                $this->session->set_userdata('upload_video',array('upload_video'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name']));
                                else{
                                $content = $this->session->userdata('upload_video');
                                $this->session->set_userdata('upload_video',array('upload_video'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name']));   
                                return TRUE;
                                }   
                           return TRUE;
                                
                            }else{     
                            $this->form_validation->set_message('upload_video', $this->upload->display_errors());
                             return FALSE;     
                                   
                            }
                
        endif;
       
     }
     
    public function edit_design($design_id='')
    {
            $data['design']=$this->user_model->get_row('design',array('id' =>$design_id));
            $file = $data['design']->design_image;
            $old_slug = $data['design']->slug;
          
                $this->form_validation->set_rules('artist', 'artist', 'required');              
                $this->form_validation->set_rules('design_title', 'design_title', 'required');
                $this->form_validation->set_rules('description', 'description', 'required');
                 $this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_dgn_slug['."edit".','.$old_slug.']');
                $this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');

                if($_FILES['designfile']['name']!=''){
                 $this->form_validation->set_rules('designfile', 'designfile', 'callback_check_img_size['."edit".']');   
                }

               if(!empty($_FILES['upload_video']['name'])){
                    $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
                }

          if($this->form_validation->run()==TRUE)
          {
           
           if($this->session->userdata('upload_video')!=''){ 
                $upload_video=$this->session->userdata('upload_video');
                $data1['design_video'] = $upload_video['upload_video'];  
                $data1['design_video_type']  = $this->input->post('design_video_type');
            }else if(!empty($_POST['design_video'])){
                $data1['design_video'] = $this->input->post('design_video');
                $data1['design_video_type']  = $this->input->post('design_video_type');
            }
                 
           
                $data1['artist'] = $this->input->post('artist');
                $data1['artist_id'] = customer_id();
                $data1['design_title'] = $this->input->post('design_title');
                $data1['slug'] = $this->input->post('slug');
                $data1['description'] = $this->input->post('description');
                $data1['category'] = serialize($this->input->post('category'));
                $data1['created'] = date('Y-m-d');
                  /*  if($_FILES['designfile']['name']!='')
                    {               
                        $config['upload_path'] = './assets/uploads/designs';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '99999999';
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('designfile'))
                        {
                            $this->session->set_flashdata('image_error'.$do_upload['error']);
                            //redirect('superadmin/add_product/');
                        }
                        else
                        {
                            $path='./assets/uploads/designs/';
                            if(!empty($file)){
                                @unlink($path.$file);
                                @unlink($path.'thumbnail/'.$file);          
                            }
                            $upload_data = $this->upload->data();
                            $data['design_image']=$upload_data['file_name'];
                            $this->designs_thumb_file($data['design_image']);
                        }
                    }*/
                    // print_r($data);
                    // die();
                if ($this->session->userdata('upload_video')!='') {
                    if($video = $this->user_model->get_row('design',array('id'=>$design_id))){
                        unlink($video->design_video);
                     }
                }
                
                    $this->user_model->update('design',$data1,array('id'=>$design_id));
                     if($this->session->userdata('upload_video')!=''):
                        $this->session->unset_userdata('upload_video');
                    endif;
                    $this->session->set_flashdata('success_msg',"Design has been updated successfully.");
                    redirect('user/dashboard_designs');
                }
            
            $data['category']=  $this->user_model->get_result('design_category');
            $data['template'] = 'user/edit_design';
            $this->load->view('templates/user_template', $data);
    }

      public function check_dgn_slug($slug, $params){
        $param = explode(',', $params);
        $called = $param[0];
        $old_slug = $param[1];
        if ($called === 'add'){
            $resp = $this->user_model->get_row('design', array('slug' => $slug));
            if ($resp){
                $this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
                return FALSE;
            }else
                return TRUE;
        }elseif ($old_slug === $slug) {
                return TRUE;
        }else{
            $resp = $this->user_model->get_row('design', array('slug' => $slug));
            if ($resp) {
                $this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }


    public function orders($offset=0)
    {
        $login = $this->check_login();
        if (!$login) {
            redirect("store/login");
        }
        $uid = customer_id();
        if (!$uid) {
            $this->session->set_flashdata('error_msg', 'No order found');
            redirect('user/dashboard');
        }
        $limit=10;      
        $data['orders']=$this->user_model->orders($limit,$offset,$uid);
        // print_r($data['orders']);
        // die();
        $config= get_pagination_style();    
        $config['base_url'] = base_url().'user/orders/';
        $config['total_rows'] = $this->user_model->orders(0, 0,$uid);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);         
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'user/orders';
        $this->load->view('templates/user_template', $data);
    }

    public function order_info($order_id=''){
        $oid = 0;
        // $order = $this->user_model->get_row('orders', array('id' => $order_id));
        //     $oid = $order->order_id;
            $user_data = $this->user_model->order_user_info($order_id);
            $data['order_user_info'] = $user_data;
            $data['order_info'] = $this->user_model->order_info($order_id);
            $data['order_id'] = $oid;
            // print_r($data);
            // die();
        $data['template'] = 'user/order_info';
        $this->load->view('templates/user_template', $data);       
    }
    // ritesh Done
     public function pay_request()
    {
        $this->check_login();
         $uid = customer_id();
        $com_rate = 0.00;
        $com_amount = 0.00;
        $com_qty = 0.00;
        if ($com_rate=commission_rate())
            $com_rate;

        if ($com_qty=user_commission($uid))
            $com_qty;

            $com_amount=$com_rate*$com_qty;

        if ($com_amount <= 25) {
            $this->session->set_flashdata('error_msg', 'Payment request cannot completed, Unpaid Commission is Insufficient.');
            redirect('user/sales_report');
        }else{
            $resp = $this->user_model->get_row('commission_request', array('user_id' => $uid));

            if ($resp)
                $unpaid_com = ($resp->unpaid_com + $com_amount);
            else
                $unpaid_com = $com_amount;

            $data = array(
                            'user_id' => $uid,
                            'unpaid_com' => $unpaid_com,
                            'pay_status' => 0,
                            'request_date' => date('Y-m-d H:i:s')
                        );

            if ($resp) {
                $this->user_model->update('commission_request', $data, array('user_id' => $uid));
            }else{
                $this->user_model->insert('commission_request', $data);
            }

            $data = array(
                            'user_id' => $uid,
                            'unpaid_com' => $com_amount,
                            'request_date' => date('Y-m-d')
                        );

            $this->user_model->update('design_sales', array('payment_status' => 1) , array('design_owner_id' => $uid));

            $this->session->set_flashdata('success_msg', 'Your Payment Request has been accepted and will be clear Soon.');
            redirect('user/sales_report');
        }
    } 

    public function faq()
    {
        $data['faq']=$this->user_model->get_result('faq');
        $data['template'] = 'user/faq';
        $this->load->view('templates/user_template', $data);   
    } 

    

    public function do_upload($storefile){
        $this->check_login();   
        $config['upload_path'] = './assets/uploads/store';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($storefile)){
            return array('status'=> FALSE,'error' => $this->upload->display_errors());          
        }else{
            return array('status'=> TRUE,'upload_data' => $this->upload->data());           
        }
    }
    // ritesh Done

    public function sales_report($list_by=0, $from_date='-', $to_date='-', $offset=0)
    {
        if ($this->input->post('list_by')){
            $list_by = $this->input->post('list_by');
            $offset=0;
        }

        if ($this->input->post('is_clicked')){
            if ($this->input->post('is_clicked') == 1){
                $from_date = $this->input->post('from_date');
                $to_date = $this->input->post('to_date');
                $offset=0;
            }
        }

        $this->check_login();
        $uid = customer_id();
        $limit=50;

        $data['sales']=$this->user_model->sales_report($uid ,$list_by ,$from_date ,$to_date ,$limit ,$offset);
        $data['sales_history'] = $this->user_model->sales_history($uid);
        $data['total_orders'] = $this->user_model->design_sales_orders($uid);
        $data['commission_info'] = $this->user_model->commission_info($uid);
        $config = get_pagination_style();
        $config['base_url'] = base_url().'storeadmin/sales_report/'.$list_by.'/'.$from_date.'/'.$to_date.'/';
        $config['total_rows'] = $this->user_model->sales_report($uid ,$list_by ,$from_date ,$to_date ,0,0);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['list_by'] = $list_by;

        // if ($to_date != '-')
        //  $data['to_date'] = '';
        //  else
            $data['to_date'] = $to_date;

        // if ($from_date != '-')
        //  $data['from_date'] = '';
        // else
            $data['from_date'] = $from_date;

        $data['template'] = 'user/sales_report';
        $this->load->view('templates/user_template', $data);
    }

    public function messages($offset = 0){
        $this->check_login();
        $limit=10;
        $data['messages']=$this->user_model->messages($limit, $offset);
        $config= get_pagination_style();    
        $config['base_url'] = base_url().'user/messages/';
        $config['total_rows'] = $this->user_model->messages(0, 0);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);         
        $data['pagination'] = $this->pagination->create_links();
        $offset++;
        $data['offset'] = $offset;      
        $data['template'] = 'user/messages';
        $this->load->view('templates/user_template', $data);
    }

    // public function delete_message($id){
    //     $this->check_login();
    //     $this->user_model->delete('supports',array('id'=>$id));       
    //     $this->user_model->delete('conversation',array('support_id'=>$id));       
    //     $this->session->set_flashdata('success_msg','query has been deleted successfully.');
    //     redirect('user/supports');
    // }


    public function read_message($id){
        $this->check_login();
        if (empty($id)) {
            $this->session->set_flashdata('error_msg', 'Message not found....!!!');
            redirect('superadmin/messages');
        }
        $data['msg'] = $this->user_model->get_row('messages',array('id'=>$id));
        if (!$data['msg']) {
            $this->session->set_flashdata('error_msg', 'Message not found....!!!');
            redirect('storeadmin/messages');    
        }
        if ($data['msg']->status != 1)
            $this->user_model->update('messages' , array('status'=>1), array('id'=>$id));

        $data['template'] = 'user/read_message';
        $this->load->view('templates/user_template', $data);
    }
        
    public function delete_message($id=""){
        $this->check_login();

        if (empty($id)) {
            $this->session->set_flashdata('error_msg', 'Message not found....!!!');
            redirect('user/messages');
        }

        $del = $this->user_model->delete('messages',array('id'=>$id));

        if ($del)
            $this->session->set_flashdata('success_msg','Message has been deleted successfully.');
        else
            $this->session->set_flashdata('error_msg','Message cannot be deleted...!!!');

        redirect('user/messages');
    }

     public function user_payee_profile(){
    //print_r($_POST);
        $this->check_login();
        $uid = customer_id();
        $data['user'] = $this->user_model->get_row('user_payee_info',array('user_id'=>$uid));
        // / print_r($data['user']);
         $data['state']=$this->user_model->get_result('state');
        // echo $this->input->post('payee_type');
        if ($this->input->post('payee_type')==1) {

            //die;
            $this->form_validation->set_rules('payee_type', '', 'required');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            $this->form_validation->set_rules('acc_holder', 'A/C Holder Name', 'required');
            $this->form_validation->set_rules('acc_no', 'A/C number', 'required');
            $this->form_validation->set_rules('acc_type', 'A/c Type', 'required');
            $this->form_validation->set_rules('routing_no', 'Routing Number', 'required');
           }

        if ($this->input->post('payee_type')==2) {
                $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');//paypal_email
            }
          if ($this->input->post('payee_type')==3) {
            $this->form_validation->set_rules('name', 'Full name', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');              
            $this->form_validation->set_rules('state', 'State', 'required');                
            $this->form_validation->set_rules('address', 'Address', 'required');                
            $this->form_validation->set_rules('country', 'Country', 'required');                
            $this->form_validation->set_rules('zip', 'Zip', 'required|integer |exact_length[5] ');
          }
          if($this->input->post('payee_type')==0) {
            $this->form_validation->set_rules('payee_method', 'payee_method', 'required');              
          }
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');   
        
        if($this->form_validation->run() == TRUE){
            
            if ($this->input->post('payee_type')==1) {
                $data1 = array(
                    'bank_name'     => $this->input->post('bank_name'),
                    'acc_holder'    => $this->input->post('acc_holder'),
                    'acc_no'        => $this->input->post('acc_no'),
                    'acc_type'      => $this->input->post('acc_type'),
                    'routing_no'    => $this->input->post('routing_no'),
                    'payee_type'    => $this->input->post('payee_type'),
                    'updated'       => date('Y-m-d'));
            }
            if ($this->input->post('payee_type')==2) {
                $data1 = array(
                    'paypal_email'     => $this->input->post('paypal_email'),
                    'payee_type'    => $this->input->post('payee_type'),
                    'updated'       => date('Y-m-d'));
            }
            if ($this->input->post('payee_type')==3) {
                $data1 = array(
                    'full_name'     => $this->input->post('name'),
                    'address'    => $this->input->post('address'),
                    'city'        => $this->input->post('city'),
                    'state'      => $this->input->post('state'),
                    'country'    => $this->input->post('country'),
                    'zip_code'  => $this->input->post('zip'),
                    'payee_type'    => $this->input->post('payee_type'),
                    'updated'       => date('Y-m-d'));
            }
            if ($this->input->post('payee_type')==0) {
                    if($this->input->post('payee_method')==2)
                    {
                        $paypal =1;
                    }
                    else{
                        $paypal =0;
                    }
                    $data1 = array('payee_type' => $this->input->post('payee_method'),
                                        'is_paypal'=>$paypal);
                }
                 $this->user_model->update('user_payee_info', $data1, array('user_id' => $uid));
            
            $this->session->set_flashdata('success_msg', 'Account Detail has been updated successfully.');
            redirect(current_url());
        }
        $data['template'] = 'user/user_payee_profile';
        $this->load->view('templates/user_template', $data);
    }
 
   

}