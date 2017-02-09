<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();
      $this->load->model('Services_model');
			   
	}

	
	public function index($slug=0)
  {
    if(empty($slug)) redirect('/');
    $data['page'] = $this->Common_model->get_row('posts', array('status'=>'1','post_type'=>'services','post_slug'=>$slug),array(),'','');
    if(!$data['page']) redirect('/');
    $data['template'] = "frontend/services/service";
    $this->load->view('templates/frontend/layout', $data);
  }

  public function set_buyer_detail()
  {
    $name = $_POST['name'];
    $number = $_POST['number'];

    $this->session->set_userdata('buyer_name',$name);
    $this->session->set_userdata('buyer_contact',$number);
  }

  public function booking()
  {   
      $data['categories'] = $this->Common_model->get_result('services_category',array('parent_id'=>0,'status'=>1),array('services_category.*','(select count(sc.id) from services_category as sc where services_category.id = sc.parent_id && price_status = 0 && sc.status =1) as sub'));
      $data['artistData'] = $this->Common_model->get_result('services_artist',array('status'=>1));
      if($this->session->userdata('purchase_type'))
      {
        if($this->cart->contents())
        {          
            if($this->session->userdata('purchase_type')!= 'services')
            {
              $this->session->set_flashdata('msg_info','Please empty the cart.');

              if(isset($_SERVER['HTTP_REFERER'])) 
              {
                redirect($_SERVER['HTTP_REFERER']);
              }
              else
              {
                  redirect('/');
              }
            }
        }
        else
        {
          $this->session->set_userdata('purchase_type','services');
        }
      }
      else
      {
        $this->session->set_userdata('purchase_type','services');
      }
      $data['template'] = "frontend/services/booking";
      $this->load->view('templates/frontend/layout', $data);
  }

  public function getCategoryData($id='',$artistId='') //New
  {
      if($this->Common_model->get_row('services_category',array('id'=>$id,'parent_id >'=>0,'price_status'=>0))){
      	$html = "<option value=''>Select Sub Category</option>";
      }else{
      	$html = "<option value=''>Select Category</option>";
      }
      //$html = "<option value=''>Select Category</option>";
      $count = 0;
      //$detail = '';

      if(!empty($id)&&!empty($artistId))
      {
        $artistDetail = $this->Common_model->get_row('services_artist', array('id'=>$artistId, 'status'=>1));
        $services = (array) json_decode($artistDetail->services);
        $categoryDetails = json_decode($artistDetail->services);
          
        $subCategory = $this->Common_model->get_result('services_category',array('parent_id'=>$id, 'price_status'=>1, 'status'=>1));
        if($subCategory)
        {
        	foreach ($subCategory as $key => $value) 
        	{
        		$scid = $value->id;
        		if(isset($services["categoryPrice_$scid"]) && isset($services["categoryTime_$scid"]))
				{
	        		if($services["categoryPrice_$scid"] != 'x' && $services["categoryTime_$scid"] != '0000' && !empty($services["categoryPrice_$scid"]) && !empty($services["categoryTime_$scid"]))
	        		{
	        			$count++;
	        			$html .= "<option value='$value->id'>$value->name</option>";
	        		}
	        	}
        	}
        }else{

        	$subCategory = $this->Common_model->get_result('services_category',array('parent_id >'=>0,'price_status'=>1, 'status'=>1));
        	$subCategoryIdArry = array();
          	foreach ($subCategory as $key => $value) {
            	$subCategoryIdArry[$value->id] = $value->parent_id;
          	}

        	$category = $this->Common_model->get_result('services_category',array('parent_id'=>$id, 'price_status'=>0, 'status'=>1));

        	if($category){
	          	foreach ($category as $key => $value) {
	          		
	          		if(in_array($value->id,$subCategoryIdArry))
	          		{
						do{
							$scid = array_search($value->id,$subCategoryIdArry);
							if(isset($services["categoryPrice_$scid"]) && isset($services["categoryTime_$scid"]))
							{
								if($services["categoryPrice_$scid"] != 'x' && $services["categoryTime_$scid"] != '0000' && !empty($services["categoryPrice_$scid"]) && !empty($services["categoryTime_$scid"]))
								{
									$count++;
									$html .= "<option value='$value->id'>$value->name</option>";
									break;
								}
							}
							unset($subCategoryIdArry[$scid]);
						}while(in_array($value->id,$subCategoryIdArry));
					}
	          	}
	        }
        }

      }
      /*if(!empty($id)&&!empty($artistId))
      {
        $artistDetail = $this->Common_model->get_row('services_artist', array('id'=>$artistId, 'status'=>1));
        $categoryDetails = json_decode($artistDetail->services);
          
        $subCategory = $this->Common_model->get_result('services_category',array('parent_id'=>$id));
        if($subCategory)
        {

          $count = count($subCategory);
          if($count > 0)
          {
            $categoryIdArr = array();
            foreach ($subCategory as $key => $value){
              if(!in_array($value->id, $categoryIdArr)){
                $categoryIdArr[] = $value->id;
              }
            }

            $finalCat = array();
            $categoryDetails = json_decode($artistDetail->services);
            foreach ($categoryDetails as $key1 => $value1){
                $catId = str_replace('categoryPrice_', '', $key1);
                $catId = intval($catId);
                if(!in_array($catId, $finalCat)){
                   $finalCat[] = $catId;
                }
            } 

            if(count($finalCat)>0){
              foreach ($subCategory as $key2 => $value2){
                if(in_array($value2->id, $finalCat)&&in_array($value2->id, $categoryIdArr)){
                  $html .= "<option value='$value2->id'>$value2->name</option>";
                }
              }
            }
            if($html == ""){
              foreach ($subCategory as $key2 => $value2){
                  $html .= "<option value='$value2->id'>$value2->name</option>";
              }
            }
          }
        }

      }
      $html = "<option value=''>Select Type</option>".$html;*/

      $result = array(
                      'html'        => $html,
                      'count'       => $count
                      );

      header('Content-Type: application/json');
      echo json_encode($result);

  }
  public function getSubCategory($id='') //New
  {
      $detail = '';
      $image  = base_url('./assets/frontend/images/services/service_spray.jpg');

      $category = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0,'price_status'=>0));
      if($category){
          $detail = $category->detail;
          if(!empty($category->image) && file_exists($category->image)){
            $image  = base_url($category->image);
          }
      }

      $html = "<option value=''>Select Category</option>";
      $count = 0;
      if(!empty($id))
      {
        $subCategory = $this->Common_model->get_result('services_category',array('parent_id'=>$id,'price_status'=>0, 'status'=>1));
        if($subCategory)
        {
          $count = count($subCategory);
            if($count > 0)
            {
              foreach ($subCategory as $key2 => $value2) 
              {
                $html .= "<option value='$value2->id'>$value2->name</option>";
              }
            }
        }

      }

      $result = array(
                      'html'  => $html,
                      'count' => $count,
                      'detail'=> $detail,
                      'image' => $image
                      );

      header('Content-Type: application/json');
      echo json_encode($result);

  }

  public function getServicesList($id){

      $detail = '';
      $image  = base_url('./assets/frontend/images/services/service_spray.jpg');
      $html   = "<option value=''>Select Service</option>";
      $count  = 0;
      $i=0;
      $artist = $this->Common_model->get_row('services_artist',array('id'=>$id));
      if($artist){

        $detail = $artist->detail;
        if(!empty($artist->image) && file_exists($artist->image)){
          $image  = base_url($artist->image);
        }
        if(!empty($artist->services)){
          
          $services = (array) json_decode($artist->services);
          
          $allServices = $this->Common_model->get_result('services_category',array('parent_id'=>0,'price_status'=>0, 'status'=>1));
          
          $category = $this->Common_model->get_result('services_category',array('parent_id >'=>0,'price_status'=>0, 'status'=>1));
          $categoryIdArry = array();
          foreach ($category as $key => $value) {
            $categoryIdArry[$value->id] = $value->parent_id;
          }
          $subCategory = $this->Common_model->get_result('services_category',array('parent_id >'=>0,'price_status'=>1, 'status'=>1));
          $subCategoryIdArry = array();
          foreach ($subCategory as $key => $value) {
            $subCategoryIdArry[$value->id] = $value->parent_id;
          }
          $parentId = array();

          if($allServices)
          {
              foreach ($allServices as $key2 => $value2) 
              { 
                $sid = $value2->id;
                if(in_array($sid, $categoryIdArry))
                {
                	do{
		                $cid = array_search($sid,$categoryIdArry); //die();
		                if(in_array($cid,$subCategoryIdArry))  
		                {
		                    do{
  			                    $scid = array_search($cid,$subCategoryIdArry); 
  			                    
  			                    if(isset($services["categoryPrice_$scid"]) && isset($services["categoryTime_$scid"]))
  			                    {
  			                      if($services["categoryPrice_$scid"] != 'x' && $services["categoryTime_$scid"] != '0000' && !empty($services["categoryPrice_$scid"]) && !empty($services["categoryTime_$scid"]))
  			                      {
  			                        $i++;
  			                        $html .= "<option value='$value2->id'>$value2->name</option>";
  			                        break 2;
                              }
  			                    }
  			                    unset($subCategoryIdArry[$scid]);
		                    }while(in_array($cid,$subCategoryIdArry));
		                }
		                unset($categoryIdArry[$cid]);
		            }while(in_array($sid, $categoryIdArry));

                }
                elseif (in_array($sid,$subCategoryIdArry)) 
                {
                	do{
          						$scid = array_search($sid,$subCategoryIdArry);
          						if(isset($services["categoryPrice_$scid"]) && isset($services["categoryTime_$scid"]))
          						{
          							if($services["categoryPrice_$scid"] != 'x' && $services["categoryTime_$scid"] != '0000' && !empty($services["categoryPrice_$scid"]) && !empty($services["categoryTime_$scid"]))
          							{
          								$i++;
          								$html .= "<option value='$value2->id'>$value2->name</option>";
          								break;
          							}
          						}
          						unset($subCategoryIdArry[$scid]);
	                }while(in_array($sid,$subCategoryIdArry));

                }
              }
            }

        }
      }
      $result = array(
                      'html'   => $html,
                      //'count'  => $count,
                      'count'  => $i,
                      'detail' => $detail,
                      'image'  => $image
                      );

      header('Content-Type: application/json');
      echo json_encode($result);
  }
  
  public function getCategoryType($id='') //New
  {
      $detail = '';
      $image  = base_url('./assets/frontend/images/services/service_spray.jpg');

      $category = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0,'price_status'=>0));
      if($category){
          $detail = $category->detail;
          if(!empty($category->image) && file_exists($category->image)){
            $image  = base_url($category->image);
          }
      }

      if($this->Common_model->get_row('services_category',array('id'=>$id,'parent_id >'=>0,'price_status'=>0))){
      	$html = "<option value=''>Select Sub Category</option>";
      }else{
      	$html = "<option value=''>Select Category</option>";
      }
      $count = 0;
      if(!empty($id))
      {
        $subCategory = $this->Common_model->get_result('services_category',array('parent_id'=>$id,'price_status'=>1));
        if($subCategory)
        {
          $count = count($subCategory);
            if($count > 0)
            {
              foreach ($subCategory as $key2 => $value2) 
              {
                $html .= "<option value='$value2->id'>$value2->name</option>";
              }
            }
        }

      }

      $result = array(
                      'html'   => $html,
                      'count'  => $count,
                      'detail' => $detail,
                      'image'  => $image
                      );

      header('Content-Type: application/json');
      echo json_encode($result);

  }

  public function getArtistWeekDaysLeave($artistId=''){
      if($artistId>0){
        $artistOffData = $this->Services_model->getArtistWeekDaysLeave($artistId);
        if(count($artistOffData)){
          $leaveArr = array();
          $offWeekDay   = array();
          for($i=0;$i<count($artistOffData);$i++){
            if($i == 0){
               $offWeekDay = $artistOffData[$i]->timing;
            }
            if(isset($artistOffData[$i]->leave_on) && !empty($artistOffData[$i]->leave_on)){
              $leaveArr[]   = date('d M Y',strtotime($artistOffData[$i]->leave_on));
            }
          }
          $offWeekDayArr = json_decode($offWeekDay);
          $weekDaysArr = array();

          $artistBookHrsPerDay = $this->Services_model->getArtistDaysServicesTime($artistId);
          if(!empty($artistBookHrsPerDay)){
            for($i=0;$i<count($artistBookHrsPerDay);$i++){
              $dayIndex = date('w',strtotime($artistBookHrsPerDay[$i]->book_date));
              $timeArr  = $offWeekDayArr[$dayIndex];
              $totalSec = (((intval($timeArr[1])%100)*60)+((intval($timeArr[1])/100)*3600)) - (((intval($timeArr[0])%100)*60)+((intval($timeArr[0])/100)*3600));
              if($artistBookHrsPerDay[$i]->remaing_sec>=$totalSec){
                $leaveArr[]   = date('d M Y',strtotime($artistBookHrsPerDay[$i]->book_date));
              }

            }
          }
          if(!empty($offWeekDayArr)){
            for($i=0;$i<count($offWeekDayArr);$i++){
              if($offWeekDayArr[$i][0] == 0000 && $offWeekDayArr[$i][1] == 0000){
                $weekDaysArr[] = $i;
              }

            }
          }
        }
        $result = array("Status" => 1 , "offWeekDays"=>$weekDaysArr , "leaveDays" => $leaveArr);
      }else{
        $result = array("Status" => 0);
      }
      echo json_encode($result);
  }

  public function getRelatedArtist($cid =0) //New
  {
    $html ="<li data-artid ='0'>
              <div class='artist_info_wrp'>
                <div class='artist_name'>
                  <h2>Select Artist</h2>
                </div>
              </div>
          </li>";

    $artist = $this->Common_model->get_result('services_artist',array('status'=>1));
    $i =0;
    if($artist)
    {
      foreach ($artist as $key1 => $value1) {

          if(!empty($value1->services))
          {
            $services = (array) json_decode($value1->services);
            if(count($services)>0)
            {
              if(isset($services["categoryPrice_$cid"]) && isset($services["categoryTime_$cid"]))
              {
                if($services["categoryPrice_$cid"] != 'x' && $services["categoryTime_$cid"] != '0000' && !empty($services["categoryPrice_$cid"]) && !empty($services["categoryTime_$cid"]))
                { $i++;

                  $html .="
                      <li data-artid='$value1->id'>
                        <div class='artist_info_wrp'>
                            <div class='artist_name'>
                              <h2>$value1->name</h2>
                            </div>
                            <div class='artist_time_price'>
                              <div class='artist_time_wrp'>
                                <p> 
                                  <strong>Time</strong>
                                </p>
                                <p>".substr($services["categoryTime_$cid"],0,2).":".substr($services["categoryTime_$cid"],2,2)."</p>
                              </div>
                              <div class='artist_time_wrp'>
                                <p> 
                                  <strong>Price</strong>
                                </p>
                                <p>$".$services["categoryPrice_$cid"]."</p>
                              </div>
                            </div>
                        </div>
                      </li>";
                }
              }
            }
          }
      }
    
    }
    $result = array(
                      'html'   => $html,
                      'count'  => $i,
                      );

      header('Content-Type: application/json');
      echo json_encode($result);
  }

  public function getArtist($id) //New
  {
      $selectedArtist = array();
      $html = '<option value="">Select Artist</option>';
      $selectedArtistCount = 0;
      $artist = $this->Common_model->get_result('services_artist',array('status'=>1));
      $category = $this->Common_model->get_result('services_category',array('parent_id'=>$id,'price_status'=>1));
      
      if($artist && $category)
      {
          foreach ($artist as $artistKey => $artistValue) 
          {
              $services = (array) json_decode($artistValue->services);
              foreach ($category as $categoryKey => $categoryValue) 
              {
                  $tempCategoryID = $categoryValue->id;
                  //categoryPrice_6":"25","categoryTime_6":"0030",
                  if(!empty($services["categoryPrice_$tempCategoryID"]) && !empty($services["categoryTime_$tempCategoryID"]))
                  {
                      $selectedArtist[] = $artistValue;
                      break;
                  }
              }
          }
          $selectedArtistCount = count($selectedArtist);
          if( $selectedArtistCount > 0)
          {
            foreach ($selectedArtist as $selectedArtistKey => $selectedArtistValue) 
            {
                $html .= "<option value='$selectedArtistValue->id'>$selectedArtistValue->name</option>";
            }
          }
      }
      $result = array(
                      'html'        => $html,
                      'categoryID'  => $id,
                      'count'       => $selectedArtistCount
                      );

      header('Content-Type: application/json');
      echo json_encode($result);
  }

  public function getArtistDate($aID =0, $cID = 0) //New
  {
    $result   = array();
    $status   = 1;
    $msg      = '';
    $offDays  = array();
    $offDate  = array();
    $cTime    = '';
    $artist   = $this->Common_model->get_row('services_artist',array('id'=>$aID,'status'=>1));

    //Find off week Day
    if($artist)
    {
      $offWeekDays = json_decode($artist->timing);
      foreach ($offWeekDays as $key => $value) {
        if($value[0] == '0000' && $value[1] == '0000')
        {
          $offDays[] = $key;
        }
      }

      $allCategory = json_decode($artist->services);
      $cTime = $allCategory["categoryTime_$cID"];
      
    }
    else
    {
      $status = 0;
    }
    // #Find off week Day

    if($status)
    {
      // Artist full off dates
      $date         = date('Y-m-d',time());
      $artist_offs  = $this->Common_model->get_result('services_artist_offs',
                      array('artist_id'=>$aID,'date >'=>$date));
      if($artist_offs)
      {  
        foreach ($artist_offs as $key => $value) {
          if($value->off_type == 1){

              $offDate[] = date("d M Y", strtotime($value->date));
              unset($artist_offs[$key]);
          }
        }
      }
      // # Artist full off dates
    }

    
    $offDays = implode(',',$offDays);
    $offDate = json_encode($offDate);

    $result = array('status'=>$status, 'msg'=>$msg, 'offDays'=>$offDays, 'offDate'=>$offDate);
    header('Content-Type: application/json');
    echo json_encode($result);

  }

  public function getTimeSlots(){
    $message = '';
    $artistId         = $_POST['artistId'];
    $category_type    = $_POST['category_type'];
    $services_date    = $_POST['services_date'];
    $format_date      = date('Y-m-d', strtotime($services_date));
    $artistDetail     = $this->Common_model->get_row('services_artist', array('id'=>$artistId, 'status'=>1));
    $dayOfWeek        = date('w',strtotime($services_date));
    $weekDaysTiming   = json_decode($artistDetail->timing);
    //print_r($weekDaysTiming);die;
    $totalHrsSlot         = $weekDaysTiming[$dayOfWeek];

    /*************Get Artist total working hours start*********************/
    $totalHrs = 0;
    $timeHrs = array();
    if(count($totalHrsSlot)>0){
      for($i=0;$i<count($totalHrsSlot);$i++){
        $timeHrs[] = date("Y-m-d ",strtotime($format_date)).implode(':',str_split($totalHrsSlot[$i], 2)).":00";
      }
      $totalHrs = (strtotime($timeHrs[1]) - strtotime($timeHrs[0]))/3600;
    }
    /*************Get Artist total working hours end*********************/

    /*************Get Artist price and time to complete service start*********************/
    $categoryDetails = json_decode($artistDetail->services);
    $price = 0;
    $serviceTime = "00:00";
    $serviceSec  = 0;
    if(!empty($categoryDetails)){
      $priceStr = 'categoryPrice_'.$category_type;
      $timeStr = 'categoryTime_'.$category_type;
      $price = $categoryDetails->$priceStr;
      $serviceTimeArr = str_split($categoryDetails->$timeStr, 2);
      $serviceSec = (intval($serviceTimeArr[0])*3600) + (intval($serviceTimeArr[1])*60);
      $serviceTime = implode(':',$serviceTimeArr);

    }
    /************c*total time slots according to service end*********************/


    /*************Artist Avalible time slot Start*********************/
    $mainSlotArr = array();
    $status = 0;
    if($totalHrs>0){

      /*************total time slots according to service start*********************/
      $slotHrs  = array();
      $totalSlots = ceil($totalHrs*3600/$serviceSec);
      for($i=0;$i<$totalSlots;$i++){
        $slotHrs[] = array('start' => date('Y-m-d H:i:s',(strtotime($timeHrs[0])+($serviceSec*($i)))),
                            'end' => date('Y-m-d H:i:s',(strtotime($timeHrs[0])+($serviceSec*($i+1)))));
      }
      /*************total time slots according to service end*********************/
      
      /*************Artist blocked slots start*********************/
        

        /*************artist off time slots start*********************/
        $blockHrs = array();
        $artistOffData  = $this->Common_model->get_result('services_artist_offs', 
                          array('artist_id'=> $artistId, 'date'=>$format_date, 'off_type' => 2) );
        if(!empty($artistOffData)){
          for($i=0;$i<count($artistOffData);$i++){
            $blockHrs[] = array("start" => $format_date.' '.implode(':',str_split($artistOffData[$i]->time_from, 2)).":00",
                                "end"   => $format_date.' '.implode(':',str_split($artistOffData[$i]->time_to, 2)).":00");
          }
        }
        /*************artist off time slots end*********************/

        /*************artist already booked slots start*********************/
        $artistBookingData  = $this->Common_model->get_result('services_bookings', 
                          array('artist_id'=> $artistId, 'book_date'=>$format_date));
        //print_r($artistBookingData);die;
        if(!empty($artistBookingData)){
          for($i=0;$i<count($artistBookingData);$i++){
            $blockHrs[] = array("start" => $format_date.' '.implode(':',str_split($artistBookingData[$i]->time_from, 2)).":00",
                                "end"   => $format_date.' '.implode(':',str_split($artistBookingData[$i]->time_to, 2)).":00");
          }
        }
        /*************artist already booked slots end*********************/
        //print_r($blockHrs);

      /************* Artist blocked slots end*********************/
      

      /************* Create Artist Time Slots Start********************/
      if(count($slotHrs)>0){
        
        for($x=0;$x<count($slotHrs);$x++){
          $temp = array(date('H:i',strtotime($slotHrs[$x]['start'])),date('H:i',strtotime($slotHrs[$x]['end'])));
          $tempStr = implode(' - ', $temp);
          
          if(count($blockHrs)>0){
            
            for($y=0;$y<count($blockHrs);$y++){
            
              if((((strtotime($slotHrs[$x]['start'])<strtotime($blockHrs[$y]['start']))&&(strtotime($slotHrs[$x]['end'])<=strtotime($blockHrs[$y]['start'])))||((strtotime($slotHrs[$x]['start'])>=strtotime($blockHrs[$y]['end']))&&(strtotime($slotHrs[$x]['end'])>strtotime($blockHrs[$y]['end']))))&&((strtotime($slotHrs[$x]['start'])>=strtotime($timeHrs[0]))&&(strtotime($slotHrs[$x]['end'])<=strtotime($timeHrs[1])))){
                if(!in_array($tempStr,$mainSlotArr)){
                  $mainSlotArr[] = $tempStr;  
                }
              }
            
            }

          }else{
            if(!in_array($tempStr,$mainSlotArr)&&((strtotime($slotHrs[$x]['start'])>=strtotime($timeHrs[0]))&&(strtotime($slotHrs[$x]['end'])<=strtotime($timeHrs[1])))){
              $mainSlotArr[] = $tempStr;  
            }
          }
        }
        if(count($mainSlotArr)>0){
          $status = 1;
        }else{
          $message = "All Slots are booked.";
        }
      }

      /************* Create Artist Time Slots End********************/
    }else{
      $message = "No Time Slots";
    }
    /*************Artist Avalible time slot End*********************/
    echo json_encode(array('data' => $mainSlotArr,'status' => $status,'message'=>$message));
    die;
  }

  public function getArtistTiming() //New
  {
    $status = 1;
    $html   = "<option value=''> Select Time </option>";
    $msg    = "";
    $flag   = 1;

    $artistId         = $_POST['artistId'];
    $category_type    = $_POST['category_type'];
    $services_date    = $_POST['services_date'];
    //$num_of_bookings  = $_POST['num_of_bookings'];

    $artistDetail     = $this->Common_model->get_row('services_artist', array('id'=>$artistId, 'status'=>1));
    $artistOffDay     = json_decode($artistDetail->timing);

    $artistOff        = $this->Common_model->get_result('services_artist_offs', 
                        array('artist_id'=> $artistId, 'date'=>date('Y-m-d', strtotime($services_date) ) ) );

    $artistFulldayOff  = array();
    $artistSpecificOff = array();

    if($artistOff)
    {
      foreach ($artistOff as $key => $value) 
      {
        if($value->off_type == 1)
        {
            $artistFulldayOff[] = $value;
        }
        else
        {
            $artistSpecificOff[] = $value;
        }
      }
    }

    $servicesDay = date('w', strtotime($services_date));

    if( $artistOffDay[$servicesDay][0] == 0 &&  $artistOffDay[$servicesDay][1] == 0)
    {
        $flag = 0;
    }

    if(count($artistFulldayOff)>0 && $flag)
    {
        $flag = 0;
    }

    if($flag)
    {
      //time sol
    }

    $result = array('status'=>$status,'html'=>$html);
    header('Content-Type: application/json');
    echo json_encode($result);


  }

  public function get_price($id=0)
  {
    if(empty($id))
    {
      echo 0;
    }
    else
    {
      echo get_services_list($id)->price;
    }

  }

  public function get_timing_option($time=0)
  {
        $time = str_replace('-',' ',$time);

        $status=1;
        $time = date('Y-m-d',strtotime($time));
        $time_list =  $this->Common_model->get_result('services_timing',array('status'=>1));
        $time_array = array();
        if($time_list)
        {
          $booked_slot = $this->Common_model->get_result('services_booking',array('book_date'=>$time));
          if($booked_slot)
          {
              foreach ($time_list as $time_row) 
              {
                  $slot_count = 0;
                  foreach ($booked_slot as $book_row) 
                  {
                      if($book_row->book_time_id == $time_row->id)
                      {
                          $slot_count = $slot_count + $book_row->slot;
                      }
                  }
                  if($slot_count < $time_row->max_booking)
                  {
                    $time_array[] = $time_row;
                  }
              }
              if(count($time_array)<1)
              {
                $status=1;
                $time_array = $time_list;
              }
          }
          else
          {
            $status=1;
            $time_array = $time_list;
          }
        }
        else
        {
          $status = 0;
        }

        if($status)
        {
          echo "<option value=''>Select Time</option>";
          foreach ($time_array as  $value) 
          {
            echo "<option value='".$value->id."'>".$value->timing."</option>";
          }
        }
        else
        {
          echo $status;
          //echo 0;
        }
  }



  public function get_slots($date=0,$time_id=0)
  { 
    $date = str_replace('-',' ',$date);
    $status = 1;
    if(empty($date) || empty($time_id))
    {
      $status = 0;
    }
    else
    { 
      $temp = "(select max_booking from services_timing where services_timing.id =".$time_id.") as max_slot";
      $time = date('Y-m-d',strtotime($date));
      $result = $this->Common_model->get_result('services_booking',array('book_date'=>$time,'book_time_id'=>$time_id),
                                        array('sum(slot) as total_slot ',$temp));
      
      if($result)
      {
        $max_slot = $result[0]->max_slot;
        $total_book_slot = $result[0]->total_slot;
        if($total_book_slot== null)
        {
          $total_book_slot = 0;
        }
        if($max_slot<=$total_book_slot)
        {
           $status = 0;
        }
        else
        {
          $max_slot = $max_slot-$total_book_slot;
        }
      }
      else
      {
        $status = 0;
      }

      if($this->cart->contents())
      {
        $cart_count=0;
        foreach ($this->cart->contents() as $cart_row) 
        {
          if($cart_row['date'] == $date && $cart_row['time_id'] == $time_id )
          {
            $cart_count = $cart_count + $cart_row['qty'];
          }

        }
        $max_slot = $max_slot - $cart_count;
        if($max_slot<1)
        {
          $status = 2;//for already add by client in cart
        }
      }

      if($status==1)
        {
                  /*echo "<option value=''>Select Slot</option>";
                  for($i=1; $i<=$max_slot; $i++ ) 
                  {
                    echo "<option value='".$i."'>".$i."</option>";
                  }*/
            $result = array('status'=>1,'max_booking'=>$max_slot);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        else
        {
            $result = array('status'=>0);
            header('Content-Type: application/json');
            echo json_encode($result);

            //echo $status;
          //echo 0;
        } 
    }
  }


  public function book_service()
  {
    // echo 0;
    // die();
    $flag  = 1;
    if($this->session->userdata('purchase_type')){
      if($this->cart->contents()){          
          if($this->session->userdata('purchase_type')!= 'services'){
            $flag  = 0;
          }
      }else{
        $this->session->set_userdata('purchase_type','services');
      }
    }else{
      $this->session->set_userdata('purchase_type','services');
    }

    if($flag){
      $artist_id = $_POST['artistId'];
      $book_date = $_POST['services_date'];
      $main_cat  = $_POST['main_category_type'];
      $cat       = $_POST['category_type']; 
      $timeSlot  = $_POST['timeSlot'];
      $service_name = $_POST['service_name'];
      if(!empty($artist_id) && !empty($book_date) && !empty($main_cat) && !empty($timeSlot))
      {  
          $artistDetail     = $this->Common_model->get_row('services_artist', array('id'=>$artist_id, 'status'=>1));
          $categoryDetails = json_decode($artistDetail->services);
          $price = 0;
          if(!empty($categoryDetails)){
            if($cat!=''){
              $priceStr = 'categoryPrice_'.$cat;
            }else{
              $priceStr = 'categoryPrice_'.$main_cat;
            }
            $price = $categoryDetails->$priceStr;
            $priceData = $this->Common_model->get_row('options',array('id'=>17));
            if($priceData)
            {
              if(!empty($priceData->option_value)){
                $price   = ($price*$priceData->option_value)/100;
              }else{
                $price   = 0;
              }
            }
          }
          $catArr[0] = $main_cat;
          if(trim($cat)!=''){
             $catArr[1] = $cat;
          }
          $category_name = $this->Services_model->getCategoryData($catArr);
          $cat_name = array();
          for($i=0;$i<count($category_name);$i++){
            $cat_name[] = $category_name[$i]->name;
          }
          $timeSlot1 = str_replace(':', "", $timeSlot); 
          $timeSlotArr = explode('-',$timeSlot1);
          $name = implode(' ', $cat_name);
          $service_id = 'service_'.$artist_id.'_'.strtotime($book_date).'_'.trim($timeSlotArr[0]).trim($timeSlotArr[1]);
          $data = array('id'    => $service_id,
                      'qty'     => 1,
                      'price'   => $price,
                      'name'    => $name,
                      'type'    => 'services',
                      'image'   => '',
                      'cat_id'  => trim($main_cat.'_'.$cat,'_'),
                      'timeSlot' => $timeSlot,
                      'artist_name' => $artistDetail->name,
                      'artist_id' => $artist_id,
                      'service_name'=>$service_name,
                      'date'    => date('Y-m-d',strtotime($book_date)));
          $items = $this->cart->contents();
          if($items)
          {
            $errorCounter = 0;
            foreach($items as $item){
              if($item['id'] ==  $service_id){
                $errorCounter++;
              }else{
                $prevtimeSlot = str_replace(':', "", $item['timeSlot']); 
                $prevtimeSlotArr = explode('-',$prevtimeSlot);
                if(((intval(trim($prevtimeSlotArr[0]))>=intval(trim($timeSlotArr[0]))) && (intval(trim($prevtimeSlotArr[0]))<=intval(trim($timeSlotArr[1]))))){
                   $errorCounter++;
                }
              }
            }
            if($errorCounter == 0){
              $result = $this->Common_model->get_row('services_bookings', array('artist_id'=>$artist_id, 'time_from' => trim($timeSlotArr[0]),'time_to' => trim($timeSlotArr[1]), 'book_date' => date('Y-m-d',strtotime($book_date))));
              if(!$result)
              {
                   //$this->session->set_flashdata('msg_success', 'Salon service sucessfully added to your cart. To book another service please select treatment type.');
                    $this->session->set_flashdata('msg_success', 'Please enter contact detail.');
                    $this->cart->insert($data);
                    echo 1;
              }
              else
              {
                  $this->session->set_flashdata('msg_error', 'Service already added in cart.');
                  echo 0;
              }
            }else
            {
                $this->session->set_flashdata('msg_error', 'Service already added in cart.');
                echo 0;
            }

             
          }
          else
          {
              //$this->session->set_flashdata('msg_success', 'Salon service sucessfully added to your cart. To book another service please select treatment type.');
              $this->session->set_flashdata('msg_success', 'Please enter contact detail.');
              $this->cart->product_name_rules = '[:print:]';
              $this->cart->insert($data);
              echo 1;
          }

      }
      else
      {
         $this->session->set_flashdata('msg_error', 'Please try again.');
         echo 1;
      } 
    }else{
      $this->session->set_flashdata('msg_error', 'Please empty the cart.');
      echo 1;
    }
    die;
  }

  public function checkout()
  {
     if($this->session->userdata('purchase_type'))
      {
          if($this->session->userdata('purchase_type') == 'services')
          {
              $this->form_validation->set_error_delimiters('<label class="form_carot">','</label>'); 
              if($this->form_validation->run('contact_detail_at_buying')==FALSE)
              {

              }
              else
              {
                  $data_array =array(
                                  'first_name'  => $this->input->post('first_name'),
                                  'last_name'   => $this->input->post('last_name'),
                                  'email'       => $this->input->post('email'),
                                  'contact'     => $this->input->post('contact')
                                      );
                  $this->session->set_userdata('buyer_detail',$data_array);
                  redirect('service/payment');
              }
              $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));
              $data['template'] = 'frontend/cart/checkout_2';
              $this->load->view('templates/frontend/layout', $data);
          }
          else
          {
            redirect('service/booking');
          }
      }
      else
      {
        redirect('service/booking');
      }
  }

  public function payment()
  {
    if($this->session->userdata('purchase_type'))
    {
      if($this->session->userdata('purchase_type') == 'services')
      {
        if(!$this->cart->contents()) redirect('service/booking');
        if( $this->session->userdata('buyer_detail'))
        {
            $data['total']              = $this->cart->total();
            $data['gst']                = 0;
            $data['shipping']           = 0;
            $data['coupon_discount']    = 0;
            $data['template']           = 'frontend/cart/payment';
            $this->load->view('templates/frontend/layout', $data);
        }
        else
        {
          redirect('service/booking');
        }
      }
      else
      {
        redirect('service/booking');
      }
    }
    else
    {
      redirect('service/booking');
    }

  }

  public function pay_paypal()
  {
      if($this->session->userdata('purchase_type'))
      {
        if($this->session->userdata('purchase_type') != 'services') redirect('service/booking');
      }
      else
      {
        redirect('service/booking');  
      }

      if(!$this->cart->contents()) redirect('service/booking');

      $this->load->library('paypalfunctions');

      $paymentAmount = 0;
      $total         = $this->cart->total(); // producttotal cart amount
      $extracharge   = 0; //shipping and other charge
      $tax           = 0; //if not required set 0
      $discount      = -0;//if not required set -0 , allways negative sign
      $coupon_code   = '';
      $items         = array();

      foreach ($this->cart->contents() as $row) 
      {
          $items[]       = array('name'=>$row['artist_name'].' '.$row['name'], 'amt' =>$row['price'], 'qty' => $row['qty'],'desc'=>'');
      
      }


      $paymentAmount = $total+$extracharge+$discount+$tax;         

      $this->session->set_userdata('payment_data',array('shipping'=> $extracharge, 'tax'=>$tax, 'total'=>$total, 'discount'=>$discount, 'coupon_code'=>$coupon_code, 'grand_total'=>$paymentAmount));

      $_SESSION["Payment_Amount"] = $paymentAmount;
      $currencyCodeType = "USD";
      $paymentType = "Sale";
              //'------------------------------------            
      $returnURL = service_returnURL;
              //'------------------------------------
      $cancelURL = service_cancelURL;

      $resArray = $this->paypalfunctions->CallShortcutExpressCheckoutWithDiss_tax( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $items, $extracharge, $tax, $discount );
          // print_r($resArray);
      if(isset($resArray["ACK"]))
      {
          $ack = strtoupper($resArray["ACK"]);
          if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
          {
            //$this->session->set_userdata('plan_slug',$data['detail']->title_slug);
            $this->paypalfunctions->RedirectToPayPal( $resArray["TOKEN"] );
          } 
          else
          {
            
            //$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
            //$this->session->set_flashdata('msg_error',$ErrorLongMsg);
            $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
            redirect('service/payment');
            //echo $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
          }
      }
      else  
      {
          //$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
          //$this->session->set_flashdata('msg_error',$ErrorLongMsg);
          $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
          redirect('service/payment');
      }
  }

  public function confirm()
  { 
    $this->load->library('paypalfunctions');
    //$plan_slug = $this->session->userdata('plan_slug');
    $PaymentOption = "PayPal";
    if ($PaymentOption == "PayPal")
    {           
      
      $finalPaymentAmount =  $_SESSION["Payment_Amount"];

      $resArray = $this->paypalfunctions->ConfirmPayment($finalPaymentAmount);
      $ack = strtoupper($resArray["ACK"]);
      if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
      {
        $transactionId      = $resArray["PAYMENTINFO_0_TRANSACTIONID"]; 
        // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
        $transactionType    = $resArray["PAYMENTINFO_0_TRANSACTIONTYPE"]; 
        //' The type of transaction Possible values: l  cart l  express-checkout 
        $paymentType        = $resArray["PAYMENTINFO_0_PAYMENTTYPE"];  
        //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
        $orderTime          = $resArray["PAYMENTINFO_0_ORDERTIME"];  
        //' Time/date stamp of payment
        $amt                = $resArray["PAYMENTINFO_0_AMT"];  
        //' The final amount charged, including any shipping and taxes from your Merchant Profile.
        $currencyCode       = $resArray["PAYMENTINFO_0_CURRENCYCODE"];  
        //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
        $feeAmt             = $resArray["PAYMENTINFO_0_FEEAMT"]; 
        //' PayPal fee amount charged for the transaction
        // $settleAmt          = $resArray["PAYMENTINFO_0_SETTLEAMT"]; 
        //' Amount deposited in your PayPal account after a currency conversion.
        $taxAmt             = $resArray["PAYMENTINFO_0_TAXAMT"];  
        
        $paymentStatus  = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"]; 
        
        $pendingReason  = $resArray["PAYMENTINFO_0_PENDINGREASON"];  

        $reasonCode     = $resArray["PAYMENTINFO_0_REASONCODE"];

        if($this->session->userdata('payment_data'))
        { 
               
              $payment_data = $this->session->userdata('payment_data');
              $buyer_detail = $this->session->userdata('buyer_detail');
              $order_detail = $this->cart->contents();
              if(user_id())
              {
                  $user_id = user_id();
              }
              else
              {
                  $user_id = 0;
              }
              $insert_id=0;
              $i=0;
              $registration_id = '';
              foreach ($order_detail as $row) 
              {
                  $timeSlot1 = str_replace(':', "", $row['timeSlot']); 
                  $timeSlotArr = explode('-',$timeSlot1);
                  $created = date('Y-m-d H:i:s');
                 // $row['date'] = str_replace('-',' ',$row['date']);

                  $i++;
                  if($i==1)
                  {
                      $result_array1  = array(
                              'booking_id'      => $insert_id,
                              'artist_id'       => $row['artist_id'],
                              'client_id'       => $user_id,
                              'first_name'      => $buyer_detail['first_name'],
                              'last_name'       => $buyer_detail['last_name'],
                              'email'           => $buyer_detail['email'],
                              'contact'         => $buyer_detail['contact'],
                              'service_id'      => $row['cat_id'],
                              'slot'            => $row['qty'],
                              'book_date'       => date('Y-m-d',strtotime($row['date'])),
                              'time_from'       => trim($timeSlotArr[0]),
                              'time_to'         => trim($timeSlotArr[1]),
                              'price'           => $row['price'],
                              //'store_location'  => $row['state'],
                              'order_detail'    => json_encode($order_detail),
                              'payment_type'    => 'paypal',
                              'transaction_id'  => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
                              'tax'             => $payment_data['tax'],
                              'total'           => $payment_data['total'],
                              'discount'        => $payment_data['discount'],
                              'coupon_code'     => $payment_data['coupon_code'],
                              'grand_total'     => $payment_data['grand_total'],
                              'fee'             => $resArray['PAYMENTINFO_0_FEEAMT']+$resArray['PAYMENTINFO_0_TAXAMT'],
                              'payment_status'  => $resArray['PAYMENTINFO_0_PAYMENTSTATUS'],
                              'response'        => json_encode($resArray),
                              'created'         => $created,
                              );

                      $insert_id = $this->Common_model->insert('services_bookings',$result_array1);
                      $registration_id = date('ymd-His',strtotime($created)).'S-'.$insert_id;
                      $this->Common_model->update('services_bookings',array('booking_id'=>$insert_id,'registration_id'=>$registration_id),array('id'=>$insert_id));
                  }
                  else
                  {   
                      $result_array1  = array(
                              'booking_id'      => $insert_id,
                              'artist_id'       => $row['artist_id'],
                              'client_id'       => $user_id,
                              'first_name'      => $buyer_detail['first_name'],
                              'last_name'       => $buyer_detail['last_name'],
                              'email'           => $buyer_detail['email'],
                              'contact'         => $buyer_detail['contact'],
                              'service_id'      => $row['cat_id'],
                              'slot'            => $row['qty'],
                              'book_date'       => date('Y-m-d',strtotime($row['date'])),
                              'time_from'       => trim($timeSlotArr[0]),
                              'time_to'         => trim($timeSlotArr[1]),
                              'price'           => $row['price'],
                              //'store_location'  => $row['state'],
                              'created'         => date('Y-m-d h:i:s')
                              );
                      $this->Common_model->insert('services_bookings',$result_array1);
                  }
              }
            $this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$registration_id.'.');

              // mail to user
            $this->load->library('chapter247_email');
            $email_template=$this->chapter247_email->get_email_template(7);

            $data['type'] ='service';
            $data['value'] = $this->Common_model->get_row('services_bookings',array('id'=>$insert_id));
            $data['message'] = $email_template->template_body;
            $html = $this->load->view('website/email',$data,true);
            //echo $html;die;
            $param=array(
                'template'  =>  array(
                                'temp'      =>  $html,
                                'var_name'  =>  array(
                                                 'user_name'  => ucfirst($buyer_detail['first_name']).' '. ucfirst($buyer_detail['last_name']),
                                                 'email'      => $buyer_detail['email'],     
                                                 'contact'    => $buyer_detail['contact'],
                                                 'order-id'   => $registration_id,
                                                    ), 
                                      ),            
                'email' =>  array(
                            'to'        =>   $buyer_detail['email'],
                            'from'      =>   NO_REPLY_EMAIL,
                            'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                            'subject'   =>   $email_template->template_subject,
                        )
              );
            $status=$this->chapter247_email->send_mail($param);



            $data['message'] = $email_template->template_body_admin;
            $html = $this->load->view('website/email',$data,true);
            //echo $html;die;
            $admin_param = array(
                'template'  =>  array(
                                'temp'      => $html,
                                'var_name'  => array(
                                                 'user_name'  => ucfirst($buyer_detail['first_name']).' '. ucfirst($buyer_detail['last_name']),
                                                 'email'      => $buyer_detail['email'],     
                                                 'contact'    => $buyer_detail['contact'],
                                                 'order-id'   => $registration_id,
                                                    ),  
                                      ),            
                'email' =>  array(
                            'to'   => SUPERADMIN_EMAIL,
                            'from'      => NO_REPLY_EMAIL,
                            'from_name' => NO_REPLY_EMAIL_FROM_NAME,
                            'subject'   => $email_template->template_subject_admin,
                        )
              );
            $status=$this->chapter247_email->send_mail($admin_param);

            $this->cart->destroy();             
            redirect('service/booking');
        }               
      }
      else  
      {
        //Display a user friendly Error on the page using any of the following error information returned by PayPal
        $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
        $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
        $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
        $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

        /*if ($this->session->userdata('buyer_detail')):
            $this->session->unset_userdata('buyer_detail');
           endif;
        $data['message'] = '<div class="alert alert-danger" role="alert"><h5>'.$ErrorLongMsg.'</h5></div>';
        $data['template']= 'frontend/paypal_error';
        $this->load->view('templates/frontend/layout',$data);*/
        $this->session->set_flashdata('msg_error',$ErrorLongMsg);
        redirect('cart');
        
        /*echo "GetExpressCheckoutDetails API call failed. ";
        echo "Detailed Error Message: " . $ErrorLongMsg;
        echo "Short Error Message: " . $ErrorShortMsg;
        echo "Error Code: " . $ErrorCode;
        echo "Error Severity Code: " . $ErrorSeverityCode;*/
      }
    }

  }
  public function cancel()
  {
    if($this->session->userdata('payment_data'))
    {
      $this->session->unset_userdata('payment_data');
    }
    $this->session->set_flashdata('msg_success','Your transaction is canceled successfully.');
        redirect('cart');
  }

  public function pay_stripe()
  { 
    
    if($this->session->userdata('purchase_type'))
    {
      if($this->session->userdata('purchase_type') != 'services') redirect('service/booking');
    }
    else
    {
      redirect('service/booking');  
    }

        $total          = $this->cart->total(); // total cart amount
        $extracharge    = 0;  //shipping and other charge
        $tax            = 0; //if not required set 0
        $discount       = -0;//if not required set -0 , allways negative sign
        $coupon_code    = '';
        $grand_total    = $total+$extracharge+$tax+$discount; 
        

        $data['descrip']      = 'Service';
        $data['amount']       = $grand_total;
        $data['card_number']  = $_POST['card_number'];
        $data['exp_month']    = $_POST['exp_month'];
        $data['exp_year']     = $_POST['exp_year'];
        $data['cvc']          = $_POST['cvc'];



    if(empty($grand_total)||empty($data['card_number'])||empty($data['exp_month'])||empty($data['exp_year'])||empty($data['cvc']))
    { 
        $this->session->set_flashdata('msg_info', 'Please enter all required fields.');
        if(isset($_SERVER['HTTP_REFERER'])) 
              {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
          redirect('service/payment');
        }
    }
    /*load stripe library */
    $this->load->library('stripe-php/init');    
    $charge = $this->init->charge($data);

    if($charge)
    {       
        if($charge['application_fee']==null) $fee = 0; else $fee = $charge['application_fee'];

        ///////////////////////////////////////////////////////////////////////////

        $buyer_detail = $this->session->userdata('buyer_detail');
        $order_detail = $this->cart->contents();
        if(user_id())
        {
            $user_id = user_id();
        }
        else
        {
            $user_id = 0;
        }
        $insert_id=0;
        $i=0;
        foreach ($order_detail as $row) 
        {
            $row['date'] = str_replace('-',' ',$row['date']);
            $i++;
            if($i==1)
            {
                $result_array1  = array(
                        'booking_id'      => $insert_id,
                        'client_id'       => $user_id,
                        'first_name'      => $buyer_detail['first_name'],
                        'last_name'       => $buyer_detail['last_name'],
                        'email'           => $buyer_detail['email'],
                        'contact'         => $buyer_detail['contact'],
                        'service_id'      => $row['cat_id'],
                        'slot'            => $row['qty'],
                        'book_date'       => date('Y-m-d',strtotime($row['date'])),
                        'book_time_id'    => $row['time_id'],
                        'price'           => $row['price'],
                        //'store_location'  => $row['state'],
                        'order_detail'    => json_encode($order_detail),
                        'payment_type'    => 'stripe',
                        'transaction_id'  => $charge['id'],
                        'tax'             => $tax,
                        'total'           => $total,
                        'discount'        => $discount,
                        'coupon_code'     => $coupon_code,
                        'grand_total'     => $grand_total,
                        'fee'             => $fee,
                        'payment_status'  => $charge['status'],
                        'response'        => json_encode($charge),
                        'created'         => date('Y-m-d h:i:s'),
                        );

                $insert_id = $this->Common_model->insert('services_booking',$result_array1);
                $this->Common_model->update('services_booking',array('booking_id'=>$insert_id),array('id'=>$insert_id));
            }
            else
            {   
                $result_array1  = array(
                        'booking_id'      => $insert_id,
                        'client_id'       => $user_id,
                        'first_name'      => $buyer_detail['first_name'],
                        'last_name'       => $buyer_detail['last_name'],
                        'email'           => $buyer_detail['email'],
                        'contact'         => $buyer_detail['contact'],
                        'service_id'      => $row['cat_id'],
                        'slot'            => $row['qty'],
                        'book_date'       => date('Y-m-d',strtotime($row['date'])),
                        'book_time_id'    => $row['time_id'],
                        'price'           => $row['price'],
                        'created'         => date('Y-m-d h:i:s')
                        );
                $this->Common_model->insert('services_booking',$result_array1);
            }
        }
        //mail function
        $this->load->library('chapter247_email');
        $email_template=$this->chapter247_email->get_email_template(7);

        $data['type'] ='service';
        $data['value'] = $this->Common_model->get_row('services_booking',array('id'=>$insert_id));
        $data['message'] = $email_template->template_body;
        $html = $this->load->view('website/email',$data,true);

        $param=array(
            'template'  =>  array(
                            'temp'      =>  $html,
                            'var_name'  =>  array(
                                             'user_name'  => ucfirst($buyer_detail['first_name']).' '.ucfirst($buyer_detail['last_name']),
                                             'email'      => $buyer_detail['email'],     
                                             'contact'    => $buyer_detail['contact'],
                                                ), 
                                  ),            
            'email' =>  array(
                        'to'        =>   $buyer_detail['email'],
                        'from'      =>   NO_REPLY_EMAIL,
                        'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                        'subject'   =>   $email_template->template_subject,
                    )
          );
        $status=$this->chapter247_email->send_mail($param);
        $this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$insert_id.'.');
        $this->cart->destroy();             
        redirect('service/booking');
    }
    else
    {
        $this->session->set_flashdata('msg_info', 'There is some error please try again.');
        if(isset($_SERVER['HTTP_REFERER'])) 
        {
          redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
          redirect('cart/payment');
        }
    }
  }

}
