<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



/*

* Excel library for Code Igniter applications
* 

*/



function excel_download($query, $filename='exceloutput', $headers='')

    {

         $ci =& get_instance();

         $ci->load->helper('download');

         $data = ''; // just creating the var for field data to append to below

         foreach ($query as $row) {

                   $line = '';

                   foreach($row as $value) {                                            

                        if (( ! isset($value)) OR ($value == "")) {

                             $value = "\t";

                        } else {

                             $value = str_replace('"', '""', $value);

                             $value = '"' . $value . '"' . "\t";

                        }

                        $line .= $value;

                   }

                   $data .= trim($line)."\n";

              }

        $data = str_replace("\r","",$data);

        force_download($filename . ".xls", $headers . "\n" . $data);

    }

function order_download($filename, $headers, $data)
{
  $ci =& get_instance();

  $ci->load->helper('download');
  
  force_download($filename . ".xls", $headers . "\n" . $data);
}

function farhan_helper()

{

	 $ci =& get_instance();

     $ci->load->library('zip_download');

	 

	 return $ci->zip_download->order_ticker();



//	return 'This is Test You Are Awesome';

}	