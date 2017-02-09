<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">

        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>
			<br>
          <div class="box paint color_0">
            <div class="title">
              <h4><span> Edit FAQ </span> </h4>
            </div>
            <!-- End .title -->
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Question
                  <span class="help-block"><?php echo form_error('question'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php if(!empty($faq->question)) echo $faq->question; ?>" class="row-fluid" name="question" placeholder="Question">
                  </div>
                </div>               
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="editor1">Answer
                  	<span class="help-block"><?php echo form_error('answer'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea  id="editor1" name="answer" rows="10" class="row-fluid"><?php if(!empty($faq->answer)) echo $faq->answer; ?></textarea>                    
                  </div>
                </div>      
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn">Submit</button>                    
                  </div>
                </div> 
            <?php echo form_close(); ?>
         </div>
      </div>      
    </div>
  </div>