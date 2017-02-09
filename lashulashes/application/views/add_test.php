 <div class="container-fluid">
  	<div class="row-fluid">
   <div class="span12 box">
  <?php if(isset($lessonupdate)){ $massage="There was problem update Lesson";}else{ $massage="There was problem add Lesson."; } ?>
   <?php if(isset($errors) && $errors !='' || (isset($file_err) ) )  
   { ?>
     <div class="alert alert-block alert-error fade in notification margin-right">
      <a class="close" data-dismiss="alert" href="#">×</a>
      <?php echo $massage; ?>
     </div>
     
     <div class="alert alert-block alert-error fade in notification margin-right">
      <a class="close" data-dismiss="alert" href="#">×</a>
      Please fix the follwing problems: </br>
       <?php  $msg =''; if(form_error('LessionModuleId') !=''){  $msg .="Module,";}?>
       <?php if(form_error('LessionName') !=''){  $msg .="  "."Name,";}?>
		
		<?php if(form_error('LessionTips') !=''){  $msg .="  "."Tips,";}?>
		     
       <?php if(isset($msg) && $msg !='' ){ echo   $msg."  " ."field is required"; }?>
     </div>
       <?php  
   }?>
    <div  id="header_message" style="display: none"  class="alert alert-block alert-error fade in notification margin-right">
      <a class="close" data-dismiss="alert" href="#">×</a>
      <?php echo "There was problem in add lesson"; ?>
     </div>
     <div class="box-header"><h3><i class="icon-plus-sign"></i> <?php if(isset($form_heading)) { echo $form_heading; } ?></h3></div>
        <div class="box-content">
            <div class="content-inner">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                  
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <div class="row-fluid">
                            <div class="span9">
                       
                                   <form action=""  class="form-horizontal" method="post" enctype="multipart/form-data" />
                                        <div class="control-group">
                                      <label class="control-label">Course</label>
                                      <div class="controls">
                                      <select name="courceid"  id="courceid"  onchange="show(this.value)">
                                        <option value="">Select Course Name</option>
                                        <?php  for($i=0;$i<count($cource);$i++){ ?>
                                        <option value="<?php echo $cource[$i]->CourseId ?>"   ><?php echo $cource[$i]->CourseName;  ?></option>
                                        <?php } ?>
                                        </select>
                                      <div class="form_error" id="cource_id" style="display: none" >Course field must be required</div>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label">Module </label>
                                      <div class="controls" id="control">
                                      <select name="LessionModuleId" id="moduleid">
                                        <option value="">Select Module Name</option>
                                    
                                        </select>
                                        <p class="content-below">Note:Please select course type first</p> 
                                      <div class="form_error" id="module_error" style="display:none">Module field must be required</div>
                                      </div>
                                    </div>
                                    
                                 <div class="control-group">
										<label class="control-label">View Type </label>
                                     <div class="controls">
										<div class="view_layout">
											<input type="hidden" id="view1" name="LessonViewTypeId"  value="1" class="radioView">
												<a  class="viewimg group1"  href="<?php echo base_url() ?>images/lesson_images/lesson3@320.jpg">
													<img id="less_img1"  src="<?php echo base_url() ?>images/lesson_images/lesson3@120.jpg">
												</a>
												<div class="viewtext content-below">Text Content Below</br> Image</div>
									     </div>
                 
									 <div style="clear: both"></div>      
                                   
                                    </div>
                               </div>
                                    
                                      <div class="control-group">
                                      <label class="control-label"> Name</label>
                                      <div class="controls">
                                        <input type="text" name="LessionName" id="LessonName" class="input-xlarge" value="<?php if(isset($_POST['LessionName'])){ echo $_POST['LessionName'];  } else {  if(isset($lessonupdate)) { echo  $lessonupdate[0]->LessionName; } } ?>" />
                                      <div class="form_error" id="lesson_error" style="display: none">Lesson name required</div>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="control-group">
                                      <label class="control-label">Tips </label>
                                      <div class="controls">
                                        <textarea class="input-xlarge" id="LessionTips"  name="LessionTips" rows="3"><?php if(isset($_POST['LessionTips'])){ echo $_POST['LessionTips'];  } else {  if(isset($lessonupdate)) { echo  $lessonupdate[0]->LessionTips ; } } ?></textarea>
                                         <div class="form_error" id="titps_error" id="tips_error" style="display: none">Tips field required</div>
                                      </div>
                                    </div>
                            
                                  <div class="control-group">
                                      <label class="control-label">Top Content </label>
                                      <div class="controls">
                                        <textarea  class="input-xlarge" id="editor1"  name="LessionTopContent" rows="3"></textarea>
                                         <div class="form_error" id="top_error"  style="display: none">Tips field required</div>
                                      </div>
                                    </div>
                            
                               <div class="control-group">
                                      <label class="control-label">Bottom Content </label>
                                      <div class="controls">
                                        <textarea class="input-xlarge" id="LessionBottomContent"  name="LessionBottomContent" rows="3"></textarea>
                                         <div class="form_error" id="bottom_error"  style="display: none">Tips field required</div>
                                      </div>
                                    </div>
                                    
                                    	<div class="control-group">
									<label class="control-label">Right Content </label>
									<div class="controls">
									<textarea class="input-xlarge" id="LessionTopRightContent"  name="LessionTopRightContent" rows="3"></textarea>
									</div>
									</div>
                                    
                             <div class="control-group">
                                      <label class="control-label">Paid Status</label>
                                      <div class="controls">
                                     <select id="PaidStatus" name="PaidStatus">  
                                     	<option value="1">Free</option>
                                     	<option value="0">Paid</option>
                                           	</select>
                                           <p class="content-below">Note:If you select free status this lesson is showing on the "Try it free" section in app and website</p> 
                                            <div class="form_error" id="titps_error" id="description_error" style="display: none">Tips field required</div>
                                      </div>
                                    </div>
                                       <div class="control-group">
                                      <label class="control-label"> Status</label>
                                      <div class="controls">
										 <select id="LessionStatus" name="LessionStatus">
										<option value="1" <?php if(isset($lessonupdate)){if($lessonupdate[0]->LessionStatus==1){?> selected="selected" <?php }}?>/>Active
										<option value="0"<?php if(isset($lessonupdate)){if($lessonupdate[0]->LessionStatus==0){?> selected="selected" <?php }}?> />Inactive
										</select>
                                       <p class="content-below">Note:Only active lesson are showing on app and website</p> 
                                      </div>
                                    </div>
                             <div class="bottomline"></div>    
                             
                                     
                                     
                                     
                                     <div id="general_view1">   
                                  <p style="color:#666"><strong>This section is for adding contents of lesson. Added contents will show on website and app according selected view type above.</strong></p>
                                   <h3  class="content" >Content</h3>  
                                    <div class="control-group">
                                      <label class="control-label">Sentence</label>
                                      <div class="controls">
                                        <input type="text" name="LessionViewOneSentence0" id="LessionViewOneSentence0" class="input-xlarge" value="" />
                                      <div class="form_error" style="display:none" id="error_viewone_sentence0">Sentence field required</div>
                                      </div>
                                    </div>
                                     <div class="control-group">
                                      <label class="control-label">Other Sentence</label>
                                      <div class="controls">
                                        <input type="text" name="LessionViewOneOtherSentence0" id="LessionViewOneOtherSentence0" class="input-xlarge" value="" />
                                      <div class="form_error" style="display:none" id="error_viewone_other0">Sentence field required</div>
                                      </div>
                                    </div>
                                   
                                     
                                     <div class="control-group">
                                      <label class="control-label">Image</label>
                                      <div class="controls">
                                        <input type="file" name="LessionViewOneTopicImage0" id="LessionViewOneTopicImage0" class="input-xlarge" value=""  onchange="show_image('0')" />
                                        
          <p class="content-below">Note:Only jpg,jpeg,png file upload and image of size 80X80</p>                              
                                        
                                         <div class="form_error" id="error_viewone_topicimg0" style="display: none">Image field required</div>
                                         <div class="form_error" id="error_viewone_topicimgformat0" style="display: none">Please upload only jpg,jpeg,png,gif file</div>
                <div class="form_error" id="sizeimg_error0" style="display: none" >Image size should be equal to 80x80</div>
                                         
                                      </div>
                                    </div>
                                     <div class="control-group">
                                      <label class="control-label">Audio </label>
                                      <div class="controls">
                                        <input type="file" name="LessionViewOneTopicAudio0" id="LessionViewOneTopicAudio0" class="input-xlarge" value="" />
                                        <p class="content-below">Note:Only mp3 file upload</p> 
                                       <div class="form_error" id="error_viewone_audio0" style="display: none">Audio field  required</div>
                                        <div class="form_error" id="error_viewone_audioformat0" style="display:none">Please upload only mp3 file</div>
                                      </div>
                                    </div>
                                    
                                    
                                 <div class="control-group">
                                      <label class="control-label">Content Status</label>
                                      <div class="controls">
										 <select class="" id="LessionViewOneContentStatus0" name="LessionViewOneContentStatus0">
										<option value="1" />Active
										<option value="0" />Inactive
										</select>
                                       <p class="content-below">Note:Only active content are showing on app and website</p> 
                                      </div>
                                    </div>
                                    
                                    
                                    
                                  <input type="hidden"  value="1" id="count_view_one" name="count_view_one" style="width:20%"/>
                                     <div class="seprater"></div>
                                     <div class="control-group" id="imageAdd2" style="margin-left: 6px;
    margin-top: 8px;">
                                        <span class="content"  onClick="addmorecontentviewone()" id="add0"><h3>Add More Content</h3><img src="<?php echo base_url()?>img/Add_add.png"/></span>
                                    </div>  
                                   
                                </div>   
                                    
                                      <div class="control-group">
                                      <div class="controls">
										  <?php if(isset($lessonupdate)){ ?>
										  <input type="submit" name="submit" value="Update" class="btn btn-info" onclick="return validation()" />
										  <?php } else { ?>
                                        <input type="submit" name="submit" value="Save" class="btn btn-info" onclick="return validation()" />
                                        
                                        <?php } ?>
                                        <a class="btn" href="<?php echo site_url(); ?>/admin/admin/lessonlisting">Cancel</a>
                                        
                                       
                                      </div>
                                    </div>
                                   
                                </form>
                            </div>
                           
                        </div>
                    </div>
                 </div>
                 
                  <div  id="header_message1" style="display: none"  class="alert alert-block alert-error fade in notification margin-right">
      <a class="close" data-dismiss="alert" href="#">×</a>
      <?php echo "There was problem in add lesson"; ?>
     </div>
               </div>


<style>
 	
 .content
 {
 margin-left: 10px;
 }
 
 .seprater
 {
 	border: 1px solid #d5d5d5;
 	
 }
 
 </style>
 


<script src="<?php echo base_url(); ?>/js/jquery-1.7.2.min.js"></script>


<link rel="stylesheet" href="<?php echo base_url(); ?>/css/colorbox.css" />

<script>
			var js= jQuery.noConflict(); 
			
			js(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				js(".group1").colorbox({rel:'group1'});
				js("#click").click(function(){ 
					js('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>


<script>
	
	 function show_image(a) 
     { 
		 ///image size validation
		var jq= jQuery.noConflict(); 
		
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("LessionViewOneTopicImage"+a).files[0]);
		
		oFReader.onload = function (oFREvent) 
		{
            var image = new Image();
                
            image.src = oFREvent.target.result;
            image.onload = function () 
             {
				  var that=this;
                
           
                if ((this.width==80) && (this.height==80))
                 { 
                    jq("#error_viewone_topicimg"+a).hide();	
					jq("#error_viewone_topicimgformat").hide();
                  jq("#sizeimg_error"+a).hide();
                  
                }
                else 
                {  
                  that.value="";
					jq("#LessionViewOneTopicImage"+a).val("");
					jq("#sizeimg_error"+a).show();
					jq("#error_viewone_topicimg"+a).hide();	
					jq("#error_viewone_topicimgformat").hide();
					jq('#error_ViewOne_topicimgformat'+a).hide();
                }
                // access image size here & do further implementation
            };
        };
      }

	
	function show(a)
	{
		
		var jq= jQuery.noConflict(); 
		
		var link_path='<?php echo site_url(); ?>/ajax/ajax/show_module/'+a;
			  jq.ajax({ 
				url: link_path,
				success: function(data){
                             	
							if(data) {
						      
							 jq("#control").html(data);
							   
							}
								
				}
			});
			
	}
	
	
function validation()
{
	var jq= jQuery.noConflict(); 
 
 flag=true;
 
 //jq(this).prop('checked', false)
 
 //jq("#view4").('input[name=chest]:checked').val()
 
 //if(jq("#view1").prop('checked'))
 {
 
 	
 	if(jq("#courceid").val()=='')       
	{
		jq("#courceid").parents('.control-group').addClass('error');
		jq("#cource_id").show();
		flag=false;
	}
	else
	{
		jq("#courceid").parents('.control-group').removeClass('error');
		jq("#cource_id").hide();	
	}
	
	
	
	if(jq("#moduleid").val()=='')       
	{
		jq("#moduleid").parents('.control-group').addClass('error');
		jq("#module_error").show();
		flag=false;
	}
	else
	{
		jq("#moduleid").parents('.control-group').removeClass('error');
		jq("#module_error").hide();
		
	}
	
	
	
	if(jq("#LessonName").val()=='')       
	{
		jq("#LessonName").parents('.control-group').addClass('error');
		jq("#lesson_error").show();
		
	}
	else
	{
		jq("#LessonName").parents('.control-group').removeClass('error');
		jq("#lesson_error").hide();
		
	}
	
	if(jq("#LessionTips").val()=='')       
	{
		jq("#LessionTips").parents('.control-group').addClass('error');
		jq("#titps_error").show();
		flag=false;
	}
	else
	{
		jq("#LessionTips").parents('.control-group').removeClass('error');
		jq("#titps_error").hide();
		
	}
 	 var b=jq("#count_view_one").val();
 	
 	
 	
 	 for(var i=0;i<b;i++)
	  {
	  	
	  	//----- manish code for remove border red ---------- //
	  	
	  	var statusM = jq('#LessionViewOneContentStatus'+i).val();
	  	
	  	//alert(statusM);
	  	
	  	if(statusM=='1' || statusM=='0'){
			jq('#LessionViewOneContentStatus'+i).addClass('custBordM');
		}
	  	
	  	
	  	if((jq('#LessionViewOneSentence'+i).val())!=''){
			
			jq('#LessionViewOneSentence'+i).addClass('custBordM');
			
		}else{
		
			jq('#LessionViewOneSentence'+i).removeClass('custBordM');
		}
		
		
	  	if((jq('#LessionViewOneOtherSentence'+i).val())!=''){
			
			jq('#LessionViewOneOtherSentence'+i).addClass('custBordM');
			
		}else{
			
			jq('#LessionViewOneOtherSentence'+i).removeClass('custBordM');
		
		}
		
	  	//---------- -------------  end.   --------------------------//
	  	
	  	//alert("LessionViewOneSentence"+i);
	    	
	  	  if(jq("#LessionViewOneSentence"+i).val()=="")
	  	  { 
			jq("#LessionViewOneSentence"+i).parents('.control-group').addClass('error');
	  	  	jq("#error_viewone_sentence"+i).show();
	  	  	flag=false;
	  	  }
	  	   else
	  	   {
			jq("#LessionViewOneSentence"+i).parents('.control-group').removeClass('error');
	  	   	jq("#error_viewone_sentence"+i).hide();
	  	   	
	  	   }
	     
	       if(jq("#LessionViewOneOtherSentence"+i).val()=="")
	       {
			jq("#LessionViewOneOtherSentence"+i).parents('.control-group').addClass('error');
	      	jq("#error_viewone_other"+i).show();
	  	  	flag=false;
	      }
	      else
	  	   {
			jq("#LessionViewOneOtherSentence"+i).parents('.control-group').removeClass('error');
	  	   	jq("#error_viewone_other"+i).hide();
	  	   }
	      
	  
	       if(jq("#LessionViewOneTopicImage"+i).val()=="")
	       {
			   
				jq('#LessionViewOneTopicImage'+i).removeClass('custBordMforFile');
				
				jq("#LessionViewOneTopicImage"+i).parents('.control-group').addClass('error');
				jq("#error_viewone_topicimg"+i).show();
				jq("#sizeimg_error"+i).hide();
				
				flag=false;
	       }
	        
	       else
	       {
	          var txt = jq("#LessionViewOneTopicImage"+i).val().split('.').pop().toLowerCase();
	          
	          if(jq.inArray(txt, ['gif','png','jpg','jpeg']) == -1) 
	          {
				 // alert('diff format');
				  
				jq("#LessionViewOneTopicImage"+i).parents('.control-group').addClass('error');
				
				jq('#LessionViewOneTopicImage'+i).removeClass('custBordMforFile');
				
               jq("#error_ViewOne_topicimgformat"+i).show();
                
                
                
                
	            flag=false;
                           
              }
	          else
	          {
				//man code for remove border start //
				
				jq('#LessionViewOneTopicImage'+i).addClass('custBordMforFile');
				
				// end. // 
				  
				jq("#LessionViewOneTopicImage"+i).parents('.control-group').removeClass('error');
	          	jq("#error_viewone_topicimgformat"+i).hide();
	          	
						
	          }
	        	jq("#error_viewone_topicimg"+i).hide();
	        }
	          
	       if(jq("#LessionViewOneTopicAudio"+i).val()=="")
	       {
			   
			   jq('#LessionViewOneTopicAudio'+i).removeClass('custBordMforFile');
			   
				jq("#LessionViewOneTopicAudio"+i).parents('.control-group').addClass('error');
				jq("#error_viewone_audio"+i).show();
				flag=false;
	       }
	       else
	       {
	        
				var ext = jq("#LessionViewOneTopicAudio"+i).val().split('.').pop().toLowerCase();

				if(jq.inArray(ext, ['mp3']) == -1) 
				{
					jq('#LessionViewOneTopicAudio'+i).removeClass('custBordMforFile');
					
					jq("#LessionViewOneTopicAudio"+i).parents('.control-group').addClass('error');
					jq("#error_viewone_audioformat"+i).show();
					flag=false;
				}
				else
				{
					
				//man code for remove border start //
				
				jq('#LessionViewOneTopicAudio'+i).addClass('custBordMforFile');
				
				// end. //					
					
					
					
					jq("#LessionViewOneTopicAudio"+i).parents('.control-group').removeClass('error');
					jq("#error_viewone_audioformat"+i).hide();
				}
				
				
	        	
				jq("#error_viewone_audio"+i).hide();
	        }  
		}
 	
 }
	
	if(flag==false)
	{
		jq("#header_message").show();
		jq("#header_message1").show();
	}
	
	return flag;
	

}	

function show_view()
{
	var jq= jQuery.noConflict(); 
	
	jq("#general_view").show();
	
	jq("#general_content").hide();


}

	
</script>

<style>
.custBordM{
	border:1px solid #BBBBBB !important;
	color:black !important;
}

.custBordMforFile{
	color:black !important;
}

</style>



<script>

function addmorecontentviewone()
{
	
	
var j = jQuery.noConflict(); 
  var valu=j("#count_view_one").val();
  

     if(valu<10)
     {
	var currentcount=j("#count_view_one").val();
	if(currentcount>=1)
	{   
		//alert('current count=> '+currentcount);
		
		var addremove=parseInt(currentcount)-parseInt(1);
		
		//alert(addremove);
		
		var addcount=parseInt(currentcount)+parseInt(1);
	}
	j("#imageAdd2 #add0").remove();
	 
	//var  html='<div id="imagediv'+currentcount+'"><input type="text" style="width:20%" name="area_name'+addcount+'" id="image'+currentcount+'">';
	
	var  html='<div id="imagediv'+currentcount+'" style="margin-top:12px;"><div class="control-group"><label class="control-label">Sentence</label><div class="controls"><input type="text" name="LessionViewOneSentence'+currentcount+'" id="LessionViewOneSentence'+currentcount+'" class="input-xlarge custBordM" value="" /><div class="form_error" id="error_viewone_sentence'+currentcount+'" style="display:none" >Sentence field required</div></div></div><div class="control-group"><label class="control-label">Other Sentence</label><div class="controls"><input type="text" name="LessionViewOneOtherSentence'+currentcount+'" class="input-xlarge custBordM" id="LessionViewOneOtherSentence'+currentcount+'" value=""><div class="form_error" id="error_viewone_other'+currentcount+'" style="display:none">Other sentence required</div></div></div><div class="control-group"><label class="control-label">Image</label><div class="controls"><input type="file" name="LessionViewOneTopicImage'+currentcount+'" id="LessionViewOneTopicImage'+currentcount+'" class="input-xlarge custBordMforFile" value=""  onchange="show_image('+currentcount+')" /><p class="content-below">Note:Only jpg,jpeg,png file upload and image of size 80X80</p><div class="form_error" id="error_viewone_topicimg'+currentcount+'" style="display:none">Image field required</div><div class="form_error" id="error_ViewOne_topicimgformat'+currentcount+'" style="display:none">Please upload only jpg,jpeg,png file</div><div class="form_error" id="sizeimg_error'+currentcount+'" style="display: none" >Image size should be equal to 80x80</div></div></div><div class="control-group"><label class="control-label">Audio</label><div class="controls"><input type="file" name="LessionViewOneTopicAudio'+currentcount+'" id="LessionViewOneTopicAudio'+currentcount+'" class="input-xlarge custBordMforFile" value=""/><p class="content-below">Note:Only mp3 file upload</p><div class="form_error" id="error_viewone_audio'+currentcount+'" style="display:none">Audio field must be required</div><div class="form_error" id="error_viewone_audioformat'+currentcount+'" style="display:none">Please upload only mp3 file</div></div></div><div class="control-group "><label class="control-label">Content Status</label><div class="controls"><select class="custBordM" id="LessionViewOneContentStatus'+currentcount+'" name="LessionViewOneContentStatus'+currentcount+'"><option value="1">Active</option><option value="0">Inactive</option></select><p class="content-below">Note:Only active content are showing on app and website</p></div></div><div class="seprater"></div>';
	
	//if(currentcount<20)
	
		html+='<span id="add'+currentcount+'" class="content" onclick="addmorecontentviewone()"><h3>Add More Content</h3><img src="<?php echo base_url()?>img/Add_add.png"/></span><div class="form_error" id="t'+currentcount+'" style="display:none">Option field and answer field both are required</diV>';
	
	
	html+='<span id="close'+currentcount+'" onclick="removecontentviewone()"><img src="<?php echo base_url()?>img/delete.png"/></span><span class="ErrorMsg" id="error'+currentcount+'"></span>';
	html+='</div>';

	j("#imageAdd2 #add"+addremove).remove();
	j("#imageAdd2 #close"+addremove).remove();
	j("#imageAdd2").append(html);
	j("#count_view_one").val(addcount);
}
else
{	
	alert("you cant add more than 10 fields")		
}	
}

function removecontentviewone()
{
	
	var j = jQuery.noConflict(); 
	var currentcount=j("#count_view_one").val();
	
	
	if(currentcount>=1)
	{
		var currentcountchnage=parseInt(currentcount)-parseInt(1);
		var currentcountadd=parseInt(currentcount)-parseInt(2);
	}
	
	j("#count_view_one").val(currentcountchnage);
	j("#imageAdd2 #imagediv"+currentcountchnage).remove();
	
	var  html='<span id="add0'+currentcountadd+'" class="content" onclick="addmorecontentviewone()"><h3>Add More Content</h3><img src="<?php echo base_url()?>img/Add_add.png"/></span><span id="close'+currentcountadd+'" onclick="removecontentviewone()"><img src="<?php echo base_url()?>img/delete.png"/></span>';
	
	j("#imageAdd2 #imagediv"+currentcountadd).append(html);
	
	
	if(currentcountchnage == 1)
	{
		var htm ='<span  class="content" onClick="addmorecontentviewone()" id="add0"><h3>Add More Content</h3><img src="<?php echo base_url()?>img/Add_add.png"/></span>';
		j("#imageAdd2").append(htm);
	}
	
}

</script>
