<?php $segment= $this->uri->segment(2);
$segment3= $this->uri->segment(3);
 if($segment=='superadmin' || $segment=='') $dashboard='active'; else $dashboard=''; 

 if($segment=='email_templates' || $segment=='addemailtemplet' || $segment=='emailtemplateupdate' )  $emailtemplet='active'; else  $emailtemplet='';

 if($segment == 'users') $users = "active"; else $users = '';

 if($segment == 'client') $client = "active"; else $client = '';
//|| $segment=='services'
 if($segment=='about'  || $segment=='news' ||$segment=='gallery' ||$segment=='testimonials' || $segment=='pages' || $segment=='faqs' || $segment=='blogs' || $segment=='tags' || $segment=='category' || $segment=='tagslist' || $segment=='addtag'|| $segment=='tagupdate' || $segment=='contacts')  $content='active'; else  $content='';


if($segment=='about' && ($segment3==''||$segment3=='index' || $segment3=='add' || $segment3=='edit' || $segment3 =='team' || $segment3=='team_add' || $segment3=='team_edit' || $segment3=='charity' || $segment3=='charity_add' || $segment3=='charity_edit' )) $about='active'; else  $about='';

if($segment=='about' && ($segment3==''||$segment3=='index' || $segment3=='add' || $segment3=='edit' )) $about_about='active'; else  $about_about='';
/**/

if($segment=='about' && ($segment3 =='team' || $segment3=='team_add' || $segment3=='team_edit')) $about_team='active'; else  $about_team='';

if($segment=='about' && ($segment3=='charity' || $segment3=='charity_add' || $segment3=='charity_edit' )) $about_charity='active'; else  $about_charity='';

 if($segment=='supports' || $segment=='supportreply'  )  $support='active'; else  $support='';

 if($segment=='testimonials' || $segment=='addtestimonial' || $segment=='updatetestimonial'  )  $testimonial='active'; else  $testimonial='';

 if($segment=='product_category' || $segment=='attributes' || $segment=='products' || $segment=='configure_terms')  $product='active'; else  $product='';
 
 if($segment=='product_category' &&($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $Categories='active'; else  $Categories='';   

 if($segment=='attributes' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $Attributes='active'; else  $Attributes='';  

 if($segment=='products' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $products='active'; else  $products='';   
 
 if($segment=='news' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $new='active'; else  $new='';

 if($segment=='services') $services='active'; else  $services=''; 

 if($segment=='services' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $services_list ='active'; else $services_list='';
 if($segment=='services' && ($segment3=='time_range' || $segment3=='range_add' || $segment3=='range_edit' )) $services_rang ='active'; else $services_rang='';
 if($segment=='services' && ($segment3=='pricing' || $segment3=='price_edit' )) $pricing ='active'; else $pricing='';

 if($segment=='pages' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $pages='active'; else  $pages='';

 if($segment=='faqs' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $faqs='active'; else  $faqs='';   
 
 if($segment=='blogs' || $segment=='tags' || $segment=='category') $blogs='active'; else  $blogs='';

 if($segment=='blogs' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $blog='active'; else  $blog=''; 

 if($segment=='tags' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $tags='active'; else  $tags='';

 if($segment=='category' && ($segment3=='index' || $segment3=='add' || $segment3=='edit' )) $category='active'; else  $category='';

 if($segment=='gallery' ) $gallery='active'; else $gallery=''; 

 if($segment=='trainings' || $segment=='trainings_category') $manage_trainings='active'; else $manage_trainings='';

 if($segment=='trainings' ) $trainings='active'; else $trainings=''; 

 if($segment=='trainings_category') $trainings_cat='active'; else $trainings_cat=''; 

 if($segment=='member' || $segment=='member_category') $manage_member='active'; else $manage_member='';
  
 if($segment=='member') $member='active'; else $member=''; 

 if($segment=='member_category') $member_cat='active'; else $member_cat=''; 

 if($segment=='membership') $membership='active'; else $membership=''; 
 if($segment3=='plan_list') $plan_list='active'; else $plan_list='';
  if($segment3=='discount') $plan_discount='active'; else $plan_discount='';

 if($segment3=='membership_order_list') $membership_order ='active'; else $membership_order = ''; 
 if($segment=='promocode') $promocode ='active'; else $promocode =''; 
 if($segment=='elfinders') $elfinders='active'; else $elfinders=''; 
 if($segment=='contacts') $contacts='active'; else $contacts='';
 if($segment=='optionsettings') $optionsettings='active'; else $optionsettings='';

if($segment=='orders') $orders = 'active'; else $orders='';

if($segment=='orders' && ($segment3==''|| $segment3=='index')) $orders_product = 'active'; else $orders_product='';
if($segment=='orders' && ($segment3=='services')) $orders_services = 'active'; else $orders_services = '';
if($segment=='orders' && ($segment3=='training')) $orders_training = 'active'; else $orders_training = '';


 ?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php if(isset($page_title)) { echo $page_title; }else{ echo "Admin panel"; } ?></title>
 <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="icon" type="image/png" href="<?php echo FRONTEND_THEME_URL_NEW; ?>images/favicon.png">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- END GLOBAL MANDATORY STYLES bootstrap-datepicker.standalone.css-->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo BACKEND_THEME_URL ?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/admin/pages/css/style.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

<!-- print css -->
	<!-- <link rel="stylesheet" media="ptint" href="<?php //echo BACKEND_THEME_URL ?>assets/admin/pages/css/print.css" type="text/css" /> -->
	<style type="text/css" media="print">
	    @page { 
	        size: landscape;
	    }
	    body { 
	        writing-mode: lr-tb;
	    }
		.shipping_cut {
			page-break-before: always;
		}
	</style>
<!-- #print css -->
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<!--<script type="text/javascript" src="<?php //echo BACKEND_THEME_URL?>assets/angular/angular.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php //echo BACKEND_THEME_URL?>assets/angular/angular-slugify.js"></script> -->
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo BACKEND_THEME_URL; ?>assets/global/plugins/jquery-inputmask/inputmask/jquery.inputmask.js"></script>
</head>
<body id="bid" ng-app="demoapp"  class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url(); ?>backend/superadmin">
			<img src="<?php echo base_url('assets/frontend/images/backend_logo.png'); ?>" alt="logo" class="logo-default0"/>
			<!-- http://205.134.251.196/~examin8/CI/lashulashes/assets/frontend/images/logo.png -->
			<!-- Lash-U-Lashes -->
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<!-- <img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar3_small.jpg"/> -->
					<?php 
 					$user_id = $this->session->userdata('admin_id');
					$loginuser=$this->Admin_model->getColumnDataWhere('users','first_name,last_name',array('id'=>$user_id),'',''); ?>
					<span class="username username-hide-on-mobile">
					<?php if(isset($loginuser)){ echo $loginuser[0]->first_name." ".$loginuser[0]->last_name;  } ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="<?php echo base_url(); ?>backend/superadmin/profile">
							<i class="icon-user"></i> My Profile </a>
						</li>
						
						<li>
							<a href="<?php echo base_url(); ?>backend/superadmin/change_password">
							<i class="icon-lock"></i>Change password </a>
						</li>
						<li>
							<a href="<?php echo base_url('backend/superadmin/logout'); ?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>				
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="<?php echo $dashboard; ?>">
					<a href="<?php echo base_url(); ?>backend/superadmin/">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>					
					</a>
				</li>
				<li class="<?php echo $product;  ?>">
					<a href="javascript:;">
					<i class="icon-folder"></i>
					<span class="title">Manage Products</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $Categories; ?>">
							<a href="<?php echo base_url(); ?>backend/product_category/index">
							<i class="fa fa-list-alt"></i>
							 Categories </a>
						</li>

						<li class="<?php echo $Attributes; ?>">
							<a href="<?php echo base_url(); ?>backend/attributes/index">
							<i class="fa fa-list-alt"></i>
							 Attributes </a>
						</li>


						<li class="<?php echo $products; ?>">
							<a href="<?php echo base_url(); ?>backend/products/index">
							<i class="fa fa-list-alt"></i>
							 Products </a>
						</li>
						
					</ul>
				</li>
				<li class="<?php echo $manage_trainings;  ?>">
					<a href="javascript:;">
					<i class="icon-folder"></i>
					<span class="title">Manage Training</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<!-- <li class="<?php //echo $trainings_cat; ?>">
							<a href="<?php //echo base_url(); ?>backend/trainings_category/index">
							<i class="fa fa-list-alt"></i>
							 Categories </a>
						</li> -->
						<li class="<?php echo $trainings; ?>">
							<a href="<?php echo base_url(); ?>backend/trainings/index">
							<i class="fa fa-list-alt"></i>
							 Training </a>
						</li>
					</ul>
				</li>
				<li class="<?php echo $services; ?>" > 
		          <a href="javascript:;"> <i class="icon-folder"></i> <span class="title">Manage Services</span> <span class="arrow "></span></a>

		          <ul class="sub-menu">
		                <li class="<?php echo $services_list; ?>" > 
		               		<a href="<?php echo base_url('backend/services/categories'); ?>"><i class="fa fa-list-alt"></i> Services </a>
		               	</li>
		                <li class="<?php echo $services_rang; ?>" >
		                    <a href="<?php echo base_url('backend/services/artist'); ?>"> <i class="fa fa-list-alt"></i> Artist </a>
		                </li>
		                <!-- <li class="<?php //echo $pricing; ?>" >
		                    <a href="<?php //echo base_url('backend/services/pricing'); ?>backend/services/pricing"> <i class="fa fa-list-alt"></i> Services Pricing </a>
		                </li> -->
		            </ul>
		        </li>

		        <li class="<?php echo $membership; ?>" > 
		          <a href="javascript:;"> <i class="icon-folder"></i> <span class="title">Manage Membership</span> <span class="arrow "></span></a>

		          	<ul class="sub-menu">
		                <!-- <li class="<?php echo $plan_list; ?>" > 
		               		<a href="<?php echo base_url('backend/membership/plan_list'); ?>"><i class="fa fa-list-alt"></i> Plan </a>
		               	</li> -->
		                <li class="<?php echo $plan_discount; ?>" >
		                    <a href="<?php echo base_url('backend/membership/discount_list'); ?>"> <i class="fa fa-list-alt"></i> Memberships</a>
		                </li>
		                <li class="<?php echo $membership_order; ?>" >
		                    <a href="<?php echo base_url('backend/membership/membership_order_list'); ?>"> <i class="fa fa-list-alt"></i> Order</a>
		                </li>
		            </ul>
		        </li>

		        <li class="<?php echo $promocode; ?>" >
					<a href="<?php echo base_url(); ?>backend/promocode">
						<i class="fa fa-gift fa-lg"></i>
						<span class="title">Manage Promo Codes</span>
					</a>	
				</li>

		        
				
				<!-- <li class="<?php //echo $manage_member;  ?>">
					<a href="javascript:;">
					<i class="icon-folder"></i>
					<span class="title">Manage Membership</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php //echo $member_cat; ?>">
							<a href="<?php //echo base_url(); ?>backend/member_category/index">
							<i class="fa fa-list-alt"></i>
							 Categories </a>
						</li>

						<li class="<?php //echo $member; ?>">
							<a href="<?php //echo base_url(); ?>backend/member/index">
							<i class="fa fa-list-alt"></i>
							 Membership</a>
						</li>
					</ul>
				</li> -->
				<li class="<?php echo $client;  ?>">
					<a href="javascript:;">
					<i class="icon-folder"></i>
					<span class="title">Manage Distributors</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $client;  ?>">
							<a href="<?php echo base_url(); ?>backend/client/">
							<i class="fa fa-list-alt"></i>
							Distributors List </a>
						</li>
						
					</ul>
				</li>
				<li class="<?php echo $users;  ?>">
					<a href="javascript:;">
					<i class="icon-folder"></i>
					<span class="title">Manage Users</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $users;  ?>">
							<a href="<?php echo base_url(); ?>backend/users/">
							<i class="fa fa-list-alt"></i>
							Users List </a>
						</li>
						
					</ul>
				</li>

				<li class="<?php echo $orders; ?>">
					<a href="javascript:;">
					<i class="fa fa-cubes"></i>
					<span class="title">Manage Orders</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $orders_product; ?>" >
							<a href="<?php echo base_url(); ?>backend/orders">
							<i class="fa fa-shopping-cart"></i>
							Products</a>
						</li>
						<li class="<?php echo $orders_services; ?>" >
							<a href="<?php echo base_url(); ?>backend/orders/services">
							<i class="fa fa-shopping-cart"></i>
							Services</a>
						</li>					
						<li class="<?php echo $orders_training; ?>" >
							<a href="<?php echo base_url(); ?>backend/orders/training">
							<i class="fa fa-shopping-cart"></i>
							Training</a>
						</li>
					</ul>
				</li> 
				<li class="<?php echo $emailtemplet;  ?>">
					<a href="<?php echo base_url(); ?>backend/email_templates/index">
					<i class="icon-folder"></i>
					<span class="title">Manage Templates</span>
					<!-- <span class="arrow "></span> -->
					</a>
					<!-- <ul class="sub-menu">
						<li class="<?php //echo $emailtemplet;  ?>">
							<a href="<?php //echo base_url(); ?>backend/email_templates/index">
							<i class="fa fa-list-alt"></i>
							Email Templates </a>
						</li>
						
					</ul> -->
				</li>
		        <li class="<?php echo $content; ?>"> <a href="javascript:;"> <i class="fa fa-folder-open"></i> <span class="title">Manage Content</span> <span class="arrow "></span> </a>
		            <ul class="sub-menu">
		         		<li class="<?php echo $about; ?>">
				            <a href="javascript:;"><span class="title"><i class="fa fa-folder-open"></i>Manage About Us</span><span class="arrow "></span></a>

				            <ul class="sub-menu">
				                <li class="<?php echo $about_about; ?>" > 
				               		<a href="<?php echo base_url(); ?>backend/about"> <i class="fa fa-list-alt"></i>About Us Section </a>
				               	</li>
				                <li class="<?php echo $about_team; ?>" >
				                    <a href="<?php echo base_url(); ?>backend/about/team"> <i class="fa fa-list-alt"></i>Team Section</a>
				                </li>
				                <li class="<?php echo $about_charity; ?>" > 
				                    <a href="<?php echo base_url(); ?>backend/about/charity"> <i class="fa fa-list-alt"></i>Charity Section</a> 
				                </li>
				            </ul>
				          
				        </li>

				        <li class="<?php echo $testimonial; ?>">
							<a href="<?php echo base_url(); ?>backend/testimonials">
							
							<span class="title"><i class="icon-diamond"></i> Manage Testimonials</span>
							<!-- <span class="arrow "></span> -->
							</a>
							<!-- <ul class="sub-menu">
								<li class="<?php //echo $testimonial; ?>" >
									<a href="<?php //echo base_url(); ?>backend/testimonials">
									<i class="fa fa-list"></i>
									Testimonial</a>
								</li>						
							</ul> -->
						</li>

						<li class="<?php echo $gallery; ?>" >
							<a href="<?php echo base_url(); ?>backend/gallery">
							
							<span class="title"> <i class="fa fa-file-image-o" aria-hidden="true"></i> Manage Gallery</span>
							
							</a>			
						</li> 
				        <!-- <li class="<?php //echo $new; ?>" > 
				          <a href="<?php //echo base_url(); ?>backend/news/index"> <span class="title"> <i class="fa fa-file-text-o"></i>  Manage News</span> </a>
				   
				        </li> --> 
				        <li class="<?php echo $pages; ?>" > <a href="<?php echo base_url(); ?>backend/pages/index">  <span class="title"> <i class="fa fa-book"></i> Manage Pages</span>  </a>
				          
				        </li>
				        <!-- <li class="<?php //echo $services; ?>" > 
				          <a href="javascript:;"> <span class="title"> <i class="fa fa-eye"></i>  Manage Services</span> <span class="arrow "></span></a>

				          <ul class="sub-menu">
				                <li class="<?php //echo $services_list; ?>" > 
				               		<a href="<?php //echo base_url(); ?>backend/services/index"><i class="fa fa-list-alt"></i> Services </a>
				               	</li>
				                <li class="<?php //echo $services_rang; ?>" >
				                    <a href="<?php //echo base_url(); ?>backend/services/time_range"> <i class="fa fa-list-alt"></i> Time Range </a>
				                </li>
				                <li class="<?php //echo $pricing; ?>" >
				                    <a href="<?php //echo base_url(); ?>backend/services/pricing"> <i class="fa fa-list-alt"></i> Services Pricing </a>
				                </li>
				                
				            </ul>
				   
				        </li> -->

				        <li class="<?php echo $faqs; ?>">
				                 <a href="<?php echo base_url(); ?>backend/faqs/index"><span class="title"><i class="fa fa-bullhorn"></i>Manage FAQs</span></a>
				          
				        </li>
				        <li class="<?php echo $blogs; ?>">
				            <a href="<?php echo base_url(); ?>backend/blogs/index"><span class="title"><i class="fa fa-eye" aria-hidden="true"></i> Manage Media</span></a>

				            <!-- <ul class="sub-menu"> -->
				                <!-- <li class="<?php //echo $blog; ?>" > 
				               		<a href="<?php //echo base_url(); ?>backend/blogs/index"> <i class="fa fa-list-alt"></i>Blog Post </a>
				               	</li> -->
				                <!-- <li class="<?php //echo $tags; ?>" >
				                    <a href="<?php //echo base_url(); ?>backend/tags/index"> <i class="fa fa-list-alt"></i>Blog Tags </a>
				                </li> -->
				                <!-- <li class="<?php //echo $category; ?>" > 
				                    <a href="<?php //echo base_url(); ?>backend/category/index"> <i class="fa fa-list-alt"></i>Blog Categories </a> 
				                </li> -->
				            <!-- </ul> -->
				          
				        </li>
				        <li class="<?php echo $contacts; ?>">
				                 <a href="<?php echo base_url(); ?>backend/contacts"><span class="title"><i class="fa fa-globe"></i>Contact Locations</span></a>
				          
				        </li>
		            </ul>
		        </li>      
				<li class="<?php echo $support; ?>" >
					<a href="<?php echo base_url(); ?>backend/supports">
					<i class="fa fa-file-text-o"></i>
					<span class="title">Manage Support</span>
					<!-- <span class="arrow "></span> -->
					</a>
					<!-- <ul class="sub-menu">
						<li class="<?php //echo $support; ?>">
							<a href="<?php //echo base_url(); ?>backend/supports">
							<i class="fa fa-list"></i>
							Support</a>
						</li>
						
					</ul> -->
				</li>
				
				            
				
				<li class="<?php echo $elfinders ?>" >
					<a href="<?php echo base_url(); ?>backend/elfinders">
					<i class="icon-briefcase"></i>
					<span class="title">File Manager </span>
					</a>			
				</li>
				                
				<li class="<?php echo $optionsettings ?>" >
					<a href="<?php echo base_url(); ?>backend/optionsettings">
					<i class="fa fa-cogs"></i>
					<span class="title">Option Settings </span>
					</a>			
				</li>
	        </ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
<!-- <i class="fa fa-shopping-cart"></i> -->