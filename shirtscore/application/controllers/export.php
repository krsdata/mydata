<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('export_model');
	}

	private function export_download($query='',$file_name=''){
        $this->load->helper('csv');
        array_to_csv($query, $file_name);
    }

	public function export_orders(){
		  if($_POST){
            $type = $this->input->post('type');
            $export_file_format=$this->input->post('export_file_format');
            $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
            $to_date = date('Y-m-d',strtotime('+1 day', strtotime($this->input->post('to_date'))));
            if(strtolower($export_file_format)=='csv'){
                $array=$this->export_orders_csv($from_date, $to_date, $type);
                $this->export_download($array,'Orders'.date('Y-m-d').'.csv');
            }elseif(strtolower($export_file_format)=='excel'){
                $this->export_orders_excel($from_date, $to_date, $type);
            }else{
            	$data_arr['orders']=$this->export_orders_pdf($from_date, $to_date, $type);            	
                $data_arr['from_date']=$from_date;
                $data_arr['to_date']=$to_date;
                $file = $this->load->view('export/export_orders_pdf', $data_arr, TRUE);       
                $this->load->library('mpdf');        
                $this->mpdf->WriteHTML($file);
                $this->mpdf->Output('Orders'.date('Y-m-d').'.pdf','D');
            }
        }       
	}

	private function export_orders_excel($from_date='', $to_date='', $type=''){
        $data=$this->export_model->export_orders($from_date, $to_date, $type);      
        // print_r($data); die();
         // $array=array();
         // $array[]=array('Order Id','Date','Status');              
        $orders ="";
        $header = "\nOrder Id\t\tDate\t\tOrder Status\n";
        if($data):
        foreach ($data as $row) {
           $created =date('m/d/Y', strtotime($row->created)); 
           $order_id = $row->order_id;
           $order_status =  fetch_order_status($row->order_status);                                   

           // $line1 = "Order Id";
           $line2 = "#$order_id\t\t$created\t\t$order_status";

           // $line3 = "\n Date \n";
           // $line4 = "\n$created\n";

           // $line5 = "\nOrder Status\n";
           // $line6 = "\n$order_status\n";

           $orders .= "$line2\n";

        }

        // print_r($orders);
        $file_name = "orders".date('m/d/Y');
        $this->load->helper('excel_download_helper');
        	order_download($file_name,$header,$orders);
        endif;      
       // return $array;
    }

	 private function export_orders_csv($from_date='', $to_date='', $type=''){
        $data=$this->export_model->export_orders($from_date, $to_date, $type);      
         $array=array();
         $array[]=array('Order Id','Date','Status');              
        if($data):
        foreach ($data as $row) {
           $created =$row->created; 
            $order_id = $row->order_id;
            $order_status =  fetch_order_status($row->order_status);                       
            $array[]=array(
                "#".$order_id,
                $created,
                $order_status
            );         
        }
        endif;      
       return $array;
    }

    private function export_orders_pdf($from_date='', $to_date='', $type=''){
         $data=$this->export_model->export_orders($from_date, $to_date, $type);              
        if($data):
        foreach ($data as $row) {
            $created =$row->created; 
            $order_id = $row->order_id;
            $order_status =  fetch_order_status($row->order_status);   
            $array[]= (object) array(
                'order_id' => "#".$order_id,
                'created' => $created,
                'order_status'=> $order_status
            );
        }      
            return  $array;
        else:
            return  FALSE;
        endif;       
    }      

	public function export_bank($payee_type=1){
      if($_POST){
            $export_file_format=$this->input->post('export_file_format');
            $data_arr['pay_request']=$this->export_comm_pdf($payee_type);     
            $file = $this->load->view('export/export_comm_pdf', $data_arr, TRUE);       
            $this->load->library('mpdf');        
            $this->mpdf->WriteHTML($file);
            $this->mpdf->Output('Commissions '.date('Y-m-d').'.pdf','D');
         }       
    }

    public function export_cheque($payee_type=3){
      if($_POST){
            $export_file_format=$this->input->post('export_file_format');
            $data_arr['pay_request']=$this->export_comm_pdf($payee_type);     
            $file = $this->load->view('export/export_comm_cheque', $data_arr, TRUE);       
            $this->load->library('mpdf');        
            $this->mpdf->WriteHTML($file);
            $this->mpdf->Output('Commissions '.date('Y-m-d').'.pdf','D');
         }       
    }

    private function export_comm_pdf($payee_type=''){
        $data=$this->export_model->export_commssion_pdf($payee_type);   
        if($data):             
            return  $data;
        else:
            return  FALSE;
        endif;       
    }      
}/* End of file export.php */
