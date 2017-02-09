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



<script type="text/javascript">
    var rowCount = 1;
    function addMoreRows(frm) {
    rowCount ++;
    var recRow = '<div id="rowCount'+rowCount+'" class="form-group"><label class="col-md-2 control-label">Name</label><div class="col-md-8"><input placeholder="Name" name="nameadd[]" type="text" class="form-control" /></div><div class="col-md-1"> <a href="javascript:void(0);" onclick="removeRow('+rowCount+');"><i class="fa fa-times"></i></a></div></div>';
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
            //dateFormat: 'dd-mm-yy',
            dateFormat: 'd M yy',
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
            dateFormat: 'd M yy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            /*onClose: function( selectedDate ) {
              $('.start_datepicker').datepicker( "option", "maxDate", selectedDate );
            }*/
          });
          var selectedDate = $('.start_datepicker').val();
          $('.end_datepicker').datepicker( "option", "minDate", selectedDate );

        });

      $(document).ready(function() 
      {
        $('.datepicker').datepicker({
            dateFormat: 'd M yy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
        });

        $('.datepicker_tomorrow').datepicker({
            minDate: '+1',
            dateFormat: 'd M yy',
            changeMonth: false,
            changeYear: false,
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
    $('a').tooltip();   
    $(":input").inputmask();
});
</script>
<script type="text/javascript">
    $(document).ready(function($) {
        $(".timeStart").inputmask('99:99');
        $(".timeEnd").inputmask('99:99');
        $(".maskTime24").inputmask('99:99');
        /*$("#timeEnd").keyup(function(event) 
        {
          var val1 = $("#timeStart").val();
          val1 = val1.replace(/_/g,'');
          val1 = val1.replace(/:/g,'');

          var val2 = $("#timeEnd").val();
          val2 = val2.replace(/_/g,'');
          val2 = val2.replace(/:/g,'');
          if(val2.length == 4 && val1 > val2)
          {
            $("#timeEnd").val('');
          }
          
        });*/
        $(".time24").keyup(function(event) {
          var val = $(event.target).val();
          val = val.replace(/_/g,'');
          val = val.replace(/:/g,'');
          if(val.length == 1 && val > 2)
          {
            $(event.target).val('');
          }

          if(val.length == 2 && val > 23)
          {
            var val2 = val.substr(0,1);
            $(event.target).val(val2);
          }

          if(val.length == 3 )
          {
            if(val > 235)
            {
              var val2 = val.substr(0,2);
              $(event.target).val(val2);
            }
            else if(val < 235)
            {
              var val3 = val.substr(2,2);
              if( val3 > 5)
              {
                var val2 = val.substr(0,2);
                $(event.target).val(val2);
              }
            }
          }

          if(val.length == 4 && val > 2359)
          {
            var val2 = val.substr(0,3);
            $(event.target).val(val2);
          }
        });
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>