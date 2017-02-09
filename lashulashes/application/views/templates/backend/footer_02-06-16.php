<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner">
     2014 &copy; 
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>

</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>


<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>

<script src="<?php echo BACKEND_THEME_URL ?>assets/admin/js/jquery.fileuploadmulti.min.js" type="text/javascript"></script>
<!-- <script src="<?php //echo BACKEND_THEME_URL ?>assets/admin/js/ui-bootstrap-tpls-0.10.0.min.js"></script> -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0-beta.1/angular-sanitize.js"></script> -->


<div ng-controller="addtraning" class="modal fade draggable-modal" id="traning" tabindex="-1" role="basic" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add Traning</h4>
                  </div>
                  <div class="modal-body">
                        <div class="portlet-body form">
                              <form ng-submit="addtraningdada()"  name="myForm"  class="form-horizontal">
                                <div class="form-body">

                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Title</label>
                                      <div class="col-md-9">
                                        <input ng-model="formData.title" type="text" class="form-control" placeholder="Title" name="title" value="">                             
                                      </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date Range</label>
                                        <div class="col-md-8">
                                          <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                            <input ng-model="formData.start_date" type="text" class="form-control" name="from">
                                            <span class="input-group-addon">
                                            to </span>
                                            <input ng-model="formData.end_date" type="text" class="form-control" name="to">
                                          </div>
                                          <?php  //input-group ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Fee</label>
                                      <div class="col-md-9">
                                        <input ng-model="formData.fess" type="text" class="form-control" placeholder="Fee" name="fees" value="">   
                                      </div>
                                    </div>                                      
                                         
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Participant</label>
                                      <div class="col-md-9">
                                        <input ng-model="formData.participant" type="text" class="form-control" placeholder="Participant" name="participant" value="">
                                           
                                      </div>
                                    </div>     
                                    <div class="form-group">
                                       <label class="col-md-3 control-label">Description</label>
                                       <div class="col-md-9">
                                         <textarea  ng-model="formData.description" class="tinymce_edittor form-control" cols="100" rows="12" name="description"><?php echo set_value('description'); ?></textarea>
                                       </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                  <button   type="submit" class="btn blue">Save</button>
                                </div>
                             </form>
                        </div>     
                  </div>
            </div>
            <?php  //.modal-content ?>
      </div>
      <?php  //.modal-dialog ?>
</div>  

<script type="text/javascript">

    function validation()
    {
      var jq   = jQuery.noConflict();  
          flag = true;
      
      var b=jq("#count_view_one").val();
      
      
      
       for(var i=0;i<b;i++)
        {          
          //----- manish code for remove border red ---------- //
          
          var statusM = jq('#LessionViewOneContentStatus'+i).val();
          
          //alert(statusM);
      
          if((jq('#LessionViewOneSentence'+i).val())!='')
          {
            jq('#LessionViewOneSentence'+i).addClass('custBordM');            
          }
          else
          {        
            jq('#LessionViewOneSentence'+i).removeClass('custBordM');
          }
        
        
          if((jq('#LessionViewOneOtherSentence'+i).val())!='')
          {
            jq('#LessionViewOneOtherSentence'+i).addClass('custBordM'); 
          }
          else
          {
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
             
        }      
      return flag;
    } 

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
            
            var  html='<div id="imagediv'+currentcount+'" style="margin-top:12px;"><div class="control-group"><label class="control-label">Variation key</label><div class="controls"><input type="text" name="LessionViewOneSentence'+currentcount+'" id="LessionViewOneSentence'+currentcount+'" class="input-xlarge custBordM" value="" /><div class="form_error" id="error_viewone_sentence'+currentcount+'" style="display:none" >Variation key field required</div></div></div><div class="control-group"><label class="control-label">Variation value</label><div class="controls"><input type="text" name="LessionViewOneOtherSentence'+currentcount+'" class="input-xlarge custBordM" id="LessionViewOneOtherSentence'+currentcount+'" value=""><div class="form_error" id="error_viewone_other'+currentcount+'" style="display:none">Variation value required</div></div></div><div class="seprater"></div>';
            
            //if(currentcount<20)
            
              html+='<span id="add'+currentcount+'" class="content" onclick="addmorecontentviewone()"><h3>Add More Content</h3><img src="<?php echo base_url()?>assets/admin/layout/img/Add_add.png"/></span><div class="form_error" id="t'+currentcount+'" style="display:none">Option field and answer field both are required</diV>';
            
            
            html+='<span id="close'+currentcount+'" onclick="removecontentviewone()"><img src="<?php echo base_url()?>assets/admin/layout/img/delete.png"/></span><span class="ErrorMsg" id="error'+currentcount+'"></span>';
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
      
      var  html='<span id="add0'+currentcountadd+'" class="content" onclick="addmorecontentviewone()"><h3>Add More Content</h3><img src="<?php echo base_url()?>assets/admin/layout/img/Add_add.png"/></span><span id="close'+currentcountadd+'" onclick="removecontentviewone()"><img src="<?php echo base_url()?>assets/admin/layout/img/delete.png"/></span>';
      
      j("#imageAdd2 #imagediv"+currentcountadd).append(html);

      if(currentcountchnage == 1)
      {
        var htm ='<span  class="content" onClick="addmorecontentviewone()" id="add0"><h3>Add More Content</h3><img src="<?php echo base_url()?>assets/admin/layout/img/Add_add.png"/></span>';
        j("#imageAdd2").append(htm);
      }
      
    }

    var rowCount = jQuery("#rowCount").val();
    function addMoreRow(frm) 
    {
      rowCount ++;
      var recRow = '<p id="rowCount'+rowCount+'"><tr><td><input name="key[]" type="text" size="17%"  maxlength="120" /></td><td><input name="value[]" type="text" maxlength="120" style="margin: 4px 10px 0 0px;"/></td></tr> <a href="javascript:void(0);" onclick="removeRow('+rowCount+');">Delete</a></p>';
      jQuery('#addedRow').append(recRow);
    }

    function removeRow(removeNum) 
    {
      jQuery('#rowCount'+removeNum).remove();
    }

</script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>

    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    });

    var BASEURL= '<?php echo base_url(); ?>';
    //var ngApp=angular.module("demoapp", ["slugifier","ui.bootstrap"]);
 


    jQuery(document).ready(function() {    
      Layout.init(); // init layout
    });

    //$(".alert ").fadeOut(15000, function(){ $(this).remove();});
    $(".alert.alert-success").fadeOut(15000,"swing", function(){ $(this).remove();});
    $(".alert.alert-info").fadeOut(15000,"swing", function(){ $(this).remove();});
    $(".alert.alert-warning").fadeOut(15000,"swing", function(){ $(this).remove();});
    $(".alert.alert-danger").fadeOut(15000,"swing", function(){ $(this).remove();});

</script>

<script>

$(document).ready(function()
{
    var SEGMENT = '<?php echo $this->uri->segment(4); ?>';
    var SEGMENT6 = '<?php echo $this->uri->segment(6); ?>';
    if(SEGMENT6.length<1)
      SEGMENT6 = 0;
    //alert(SEGMENT6);
    var result = '';
    var count = 1;
    var settings = 
    {
      url: BASEURL+"backend/products/upload/"+SEGMENT,
      method: "POST",
      allowedTypes:"jpg,png,gif,jpeg",
      maxFileCount: 6,
      fileName: "myfile",
      multiple: true,
      onSuccess:function(files,data,xhr)
      {
        //$("#status").html("<font color='green'>Upload is success</font>");
        var obj = JSON.parse(data);
        result  = result +'<p>'+count+' ) '+files+'</p>';
        result  = result + obj[files]+'<hr>';
        count++;
        //alert(obj[files]);
        //$("#upload_status").append(obj);
        $(".upload-statusbar").remove();
      },
      afterUploadAll:function()
      {          
          //$("#upload_status").html(result);
          $.post('<?php echo base_url("backend/products/reload_image_page"); ?>',{ html:result},
           function(data) {
              if(data)
              {
                //http://localhost/lashulashes/backend/products/add_one/24/home/1
                var url = "<?php echo base_url('backend/products/add_one')?>/"+SEGMENT+'/profile/'+SEGMENT6;
               //window.location.hash = '#/profile';
               //location.reload();
               window.location.assign(url);
              }
            });
          result='';
          count= 1;
          //alert("all images uploaded!!");
          //location.reload(); 
      },
      onError: function(files,status,errMsg)
      {   
        $("#status").html("<font color='red'>Upload is Failed</font>");
      }
    }
    $("#mulitplefileuploader").uploadFile(settings);

});
</script>

<script type="text/javascript">
var rowCount = 1;
function addMoreRows(frm) {
rowCount ++;
var recRow = '<div id="rowCount'+rowCount+'" class="form-group"><label class="col-md-3 control-label">Name</label><div class="col-md-8"><input placeholder="Name" name="nameadd[]" type="text" class="form-control" /></div><div class="col-md-1"> <a href="javascript:void(0);" onclick="removeRow('+rowCount+');"><i class="fa fa-times"></i></a></div></div>';
jQuery('#addedRows').append(recRow);
}

function removeRow(removeNum) {
jQuery('#rowCount'+removeNum).remove();
}
</script>


<script type="text/javascript" src="<?php echo BACKEND_THEME_URL ?>assets/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    //selector: "textarea",
    selector: ".tinymce_edittor",
    //height : 350,
    menubar: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor media",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime table contextmenu paste textcolor",        
    ],
    image_advtab: true,
    relative_urls: false,
    convert_urls: false,
    remove_script_host : false,
    toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | preview code ",

    file_browser_callback : elFinderBrowser
    /*function(field_name, url, type, win) 
                                {
                                   var w = window.open('/elfinder/elfinder.html', null, 'width=900,height=440');
                                   w.tinymceFileField = field_name;
                                   w.tinymceFileWin = win;
                                }*/
});

function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: '<?php echo base_url("elfinders");?>',// use an absolute path!
    title: 'File Manager',
    width: 900,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}
</script>

<script>
   function input_numeric(e)
   {
      if(e.value >= 0)
      {
        
      }
      else{
       $('input[name='+e.name+']').val(''); 
      alert("Please enter value equal or greater than zero");
      }
   }

   function input_grater_then_one(e)
    {
        if(e.value > 0)
        {
          
        }
        else{
         $('input[name='+e.name+']').val(''); 
        alert("Please enter value equal or greater than one");
       }
     }
  
    $("#change_state").change(function(event) 
    {
        var state_id = this.value;
        $.post('<?php echo base_url("website/get_aus_cities")?>/'+state_id, function(data) 
        {
          $("#change_city").html(data);
        });
    });
  
    function max_text_count(e)
    {
      var maxlen = e.maxLength;
      var msg = "Maximum "+maxlen+" character are allowed.";
      var temp = e.value.length;
      var remaning = maxlen-temp;
      $("#text_count_msg").html(msg +"<span class='error'> "+remaning+" character are remaning.</span>");

    }

</script>


<script type="text/javascript">

      $(function() {
          $('.start_datepicker').datepicker({
            minDate: '<?php echo date("d-m-Y",time()+86400)?>',
            //defaultDate: "+1d",
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
              $('.end_datepicker').datepicker( "option", "minDate", selectedDate );
            }
          });

          $('.end_datepicker').datepicker({
            minDate: '<?php echo date("d-m-Y",time()+86400)?>',
            startDate: 'd',
            //defaultDate: "+1d",
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            /*onClose: function( selectedDate ) {
              $('.start_datepicker').datepicker( "option", "maxDate", selectedDate );
            }*/
          });
        });

      $(document).ready(function() 
      {
        $('.datepicker').datepicker({
            //dateFormat: 'dd-mm-yyyy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
        });
      
      });

      $(".date_icon_click").click(function(event) 
      {
        $('.datepicker').datepicker('show');
      });

      $(".start_date_icon_click").click(function(event) 
      {
        $('.start_datepicker').datepicker('show');
      });

      $(".end_date_icon_click").click(function(event) 
      {
        $('.end_datepicker').datepicker('show');
      });

</script>
<script type="text/javascript" src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery.quicksearch.js"></script>

<script type="text/javascript">
  
  $(document).ready(function() 
      {

        $('#multiSelect').multiSelect({
         selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search on list'>",
         selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search on selected list'>",
          //selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){ 
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
        
      });
</script>
<script>
$(document).ready(function(){
    $('a').tooltip(/*{
  animation: 'animated bounceInDown'
}*/);   
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>