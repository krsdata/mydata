<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Optionsettings extends CI_Controller{

    public function index(){
       if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       } //check login authentication

        $options_data = $this->Common_model->get_result('options',array('status'=>1));
        $int_array = array(14,15,16);

        foreach ($options_data as $row)
        {
            if( in_array($row->id,$int_array))
            {
                $this->form_validation->set_rules("".$row->option_name."","".$row->option_name."",'trim|required|numeric|greater_than[0]');
            }
            else
            {
                $this->form_validation->set_rules("".$row->option_name."","".$row->option_name."",'trim|required');
            }
        }

        $this->form_validation->set_rules("abc","ABC",'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE)
        {
            //print_r($_POST);
           // echo $_POST["option_name"][6];
            foreach ($options_data as $row){
               // $datas=$_POST["option_name"][$row->id];
                $post_data=array('option_value' =>trim($_POST[$row->option_name]));
                $this->Common_model->update('options',$post_data,array('option_name'=>$row->option_name));
            }
            $this->session->set_flashdata('msg_success','Option Settings updated successfully.');
            redirect('backend/optionsettings');
        }


        $data['options'] =  $options_data;
        $data['template']='backend/options';
        $this->load->view('templates/backend/layout', $data);
    }
}