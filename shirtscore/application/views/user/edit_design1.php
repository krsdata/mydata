<div class="container">
  <div class="header"><a href="#"><img src="assets/img/ss_logo.png" alt="ShirtScore" width="275px" height="64px" style="display:inline; float:left;" /></a>
  <ul class="nav">
      <li><a href="design.html">Design A Shirt</a></li>
      <li><a href="login.html">Sell Your Designs</a></li>
      <li><a href="login.html">Open A Store</a></li>
      <li><a href="faq.html">How It Works</a></li>
      <li><a href="support.html">Help?</a></li>
    </ul>
    <a href="#"><img src="assets/img/fb.png" alt="Facebook" width="64px" height="64px" style="display:inline; float:right;" /></a>
    <!-- end .header --></div>
<div class="hero_dash">
<div class="cart"><a href="#"><i class="icon-signout"></i> Logout</a></div>
<div class="dashdetails">&nbsp;<br /><h2>Your Account Dashboard</h2>
Member E-mail: user@email.tld<br />
Account Created: 6/21/2013<br />
Account ID: 65626012<br />
<br />
</div>
</div>
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div>
<ul class="dashnav">
<li><a href="dashboard.html"><i class="icon-dashboard"></i> My Dashboard</a></li>
<li><a href="dashboard_msg.html"><i class="icon-envelope"></i> Messages</a></li>
<li><a href="dashboard_designs.html"><i class="icon-picture"></i> My Designs</a></li>
<li><a href="dashboard_upload.html"><i class="icon-upload-alt"></i> Add Design</a></li>
<li><a href="dashboard_sales.html"><i class="icon-bar-chart"></i> Sales Reports</a></li>
<li><a href="dashboard_account.html"><i class="icon-user"></i> My Account</a></li>
<li><a href="dashboard_contact.html"><i class="icon-question-sign"></i> Support</a></li>
</ul>
</div>
<div class="clearfloat"></div>
<div class="dashcontent">
<div class="dashbox">
<div class="dashicon">
&nbsp;<i class="icon-edit"></i>&nbsp;
</div>
<h2>My Designs</h2>
  <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
<hr color="#ccc" />
<h3>Edit Design Info</h3>
<img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $design->design_image; ?>" style="float:left; margin:5px 25px 120px 0;" />

<h3><a href="#">Design ID </a></h3>
<strong>The Artist:</strong><br /><input type="text" name="artist" size="50" value="<?php echo $design->artist; ?>" /> <br /><br />
<strong>Design Title</strong><br /><input type="text" name="design_title" size="50" value="<?php echo $design->design_title; ?>" /><br /><br />
<strong>Description:</strong><br />
(Tell buyers more about your design. Method used, history of concept, etc.)<br />
<input type="text" size="50" name="description" value="<?php echo $design->description; ?>" /><br /><br />
<strong>Design_image:</strong><br/>

<input type="file" name="designfile" >
<br/>
<strong>Category:</strong><br />
<?php foreach ($category as $row): ?>                                          
    <input type="checkbox" name="category[]" value="<?php echo $row->id; ?>" <?php $i=0; $data=unserialize($design->category);foreach ($data as $value) {
if($value[$i]==$row->id) echo"checked";
    }$i++; ?> > <?php echo $row->category_name ?></td>
<?php endforeach ?>
<br/><br/>
<input type="submit" name="submit" value="Update" />
<?php echo form_close(); ?>
</div>
</div>
