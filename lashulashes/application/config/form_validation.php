<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
		'login'=>array(
						array(
								'field' => 'username',
								'label' => 'Email',
								'rules' =>  'trim|required|valid_email'
							),
						array(
								'field' => 'password',
								'label' => 'Password',
								'rules' => 'trim|required'
							)	
					),

		'contact'=>array(
						array(
								'field' => 'name',
								'label' => 'name',
								'rules' => 'trim|required'
							),
						array(
								'field' => 'email',
								'label' => 'email',
								'rules' =>  'trim|required|valid_email'
							),
						/*array(
								'field' => 'last_name',
								'label' => 'Last Name',
								'rules' => 'trim|required'
							),*/
						/*array(
								'field' => 'first_name',
								'label' => 'First Name',
								'rules' => 'trim|required'
							),*/
						array(
								'field' => 'comments',
								'label' => 'message',
								'rules' => 'trim|required'
							),
						array(
								'field' => 'mobile',
								'label' => 'Phone',
								'rules' => 'trim'
							)					
					),



		'changePassword' => array(				
								   array(
											'field' => 'oldpassword',
											'label' => 'Old Password',
											'rules' => 'trim|required'
										),
									array(
											'field' => 'newpassword',
											'label' => 'New Password',
											'rules' =>  'trim|required|min_length[8]'
										 ),
									
									array(
											'field' => 'retypepassword',
											'label'  => 'Retype Password',
											'rules'  =>  'trim|required|min_length[8]|matches[newpassword]'
										  )
								),  
								
							

		'category_add' => array(				
								  
									array(
											'field' => 'category_name',
											'label' => 'Name',
											'rules' =>  'trim|required|is_unique[blog_category.category_name]'
										 ),
								),

		
		'category_edit' => array(				
								  
									array(
											'field' => 'category_name',
											'label' => 'Name',
											'rules' =>  'trim|required|callback_check_updatecategory'
										 ),
								),	


		
		'product_category_add' => array(				
								  
									array(
											'field' => 'category_name',
											'label' => 'Name',
											'rules' =>  'trim|required|is_unique[product_category.category_name]'
										 ),
								),

		
		'product_category_edit' => array(				
								  
									array(
											'field' => 'category_name',
											'label' => 'Name',
											'rules' =>  'trim|required|callback_check_updateproductcategory'
										 ),
								),	

					'tags_add' 	=> array(				
											  
										array(
												'field' => 'tag_name',
												'label' => 'Name',
												'rules' =>  'trim|required|is_unique[blog_tags.tag_name]'
											 ),
									),

	   				'tags_edit' => array(				
								  
										array(
												'field' => 'tag_name',
												'label' => 'Name',
												'rules' =>  'trim|required|callback_check_updatetag'
											 ),
									),

			  'emailtemplets_add' => array(				
									  
										array(
												'field' => 'template_name',
												'label' => 'Template Name',
												'rules' =>  'trim|required'
											 ),

										array(
												'field' => 'template_subject',
												'label' => 'Template Subject',
												'rules' =>  'trim|required'
											 ),
										array(
												'field' => 'template_body',
												'label' => 'Template Body',
												'rules' =>  'trim|required'
											 ),
									),

			  'faqs_add' => array(				
								  
									array(
											'field' => 'type',
											'label' => 'Category',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'question',
											'label' => 'Question',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'answer',
											'label' => 'Answer',
											'rules' =>  'trim|required'
										 ),
									
								),

			   

			  'faqs_edit' => array(	
			  	
			  						array(
											'field' => 'type',
											'label' => 'Category',
											'rules' =>  'trim|required'
										 ),			
								  
									array(
											'field' => 'question',
											'label' => 'Question',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'answer',
											'label' => 'Answer',
											'rules' =>  'trim|required'
										 ),
									
								),

				'traning_add' => array(				
								  
									array(
											'field' => 'category',
											'label' => 'category',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'title',
											'label' => 'title',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'description',
											'label' => 'description',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'fee',
											'label' => 'fee',
											'rules' => 'trim|required|numeric|greater_than[0]'
										 ),

									array(
											'field' => 'timing',
											'label' => 'timings',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'start_date',
											'label' => 'start date',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'end_date',
											'label' => 'end date',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'participant',
											'label' => 'maximum seats',
											'rules' => 'trim|required|is_natural_no_zero'
										 ),

									array(
											'field' => 'state',
											'label' => 'location',
											'rules' => 'trim|required'
										 ),
									
								),

			   

			  'traning_edit' => array(	
			  	
			  						array(
											'field' => 'category',
											'label' => 'category',
											'rules' =>  'trim|required'
										 ),

			  						array(
											'field' => 'title',
											'label' => 'title',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'description',
											'label' => 'description',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'fee',
											'label' => 'fee',
											'rules' => 'trim|required|numeric|greater_than[0]'
										 ),

									array(
											'field' => 'timing',
											'label' => 'timings',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'start_date',
											'label' => 'start date',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'end_date',
											'label' => 'end date',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'participant',
											'label' => 'maximum seats',
											'rules' => 'trim|required|is_natural_no_zero'
										 ),

									array(
											'field' => 'state',
											'label' => 'location',
											'rules' => 'trim|required'
										 ),
									
								),								

			
			  'support_edit' => array(				
								  
									
									array(
											'field' => 'reply_message',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),
									
								),
			  'location_add' => array(				
								  
									array(
											'field' => 'type',
											'label' => 'Category',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'location',
											'label' => 'location',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'name',
											'label' => 'name',
											'rules' => 'trim|required'
										 ),

									array(
											'field' => 'mobile',
											'label' => 'contact number',
											'rules' => 'trim|required|min_length[10]'
										 ),

									array(
											'field' => 'address',
											'label' => 'address',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'city',
											'label' => 'city',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'state',
											'label' => 'state',
											'rules' =>  'trim|required'
										 ),

									array(
											'field' => 'zip',
											'label' => 'postal code',
											'rules' =>  'trim|required|min_length[4]'
										 ),

									array(
											'field' => 'country',
											'label' => 'country',
											'rules' =>  'trim|required'
										 ),
									
								),


			 
			  'testimonial_add' => array(				
								  
									
									   array(
											'field' => 'client_name',
											'label' => 'Name',
											'rules' =>  'trim|required'
										 ),

										array(
											'field' => 'location',
											'label' => 'Location',
											'rules' =>  'trim|required'
										 ),
									  	array(
											'field' => 'feedback',
											'label' => 'Feedback',
											'rules' =>  'trim|required'
										 ),

									  	/*array(
											'field' => 'features_image',
											'label' => 'Photo',
											'rules' =>  'trim|callback_testimonial_image_check_edit'
										 ),*/ 

										array(
											'field' => 'features_image',
											'label' => 'Photo',
											'rules' =>  'trim|callback_testimonial_image_check_add'
										 ),
									
								),



			  'testimonial_edit' => array(				
								  
									
										array(
											'field' => 'client_name',
											'label' => 'Name',
											'rules' =>  'trim|required'
										 ),

										array(
											'field' => 'location',
											'label' => 'Location',
											'rules' =>  'trim|required'
										 ),
									 	array(
											'field' => 'feedback',
											'label' => 'Feedback',
											'rules' =>  'trim|required'
										 ),

										array(
											'field' => 'features_image',
											'label' => 'Photo',
											'rules' =>  'trim|callback_testimonial_image_check_edit'
										 ), 
									
								),


			 
			  'news_add' => array(				
								  
									
									    array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),

									   /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|is_unique[posts.post_slug]|callback_slug_check'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|is_unique[posts.post_title]'
										 ),

										array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_edit'
										 ),
									
								),

			  'news_edit' => array(	  
									
										array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),

									    /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|callback_slug_check_edit'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|callback_slug_check_edit'
										),

										array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_edit'
										 ),
									
								),
			  
			  'time_range_add' => array(				
		
									    array(
											'field' => 'timing',
											'label' => 'timing',
											'rules' => 'trim|required'
										 ),
									    array(
											'field' => 'max_booking',
											'label' => 'allowed bookings',
											'rules' => 'trim|required|is_natural|greater_than[0]'
										 ),
									 ),

			  'time_range_edit' => array(				
		
									    array(
											'field' => 'timing',
											'label' => 'timing',
											'rules' => 'trim|required'
										 ),
									    array(
											'field' => 'max_booking',
											'label' => 'allowed bookings',
											'rules' => 'trim|required|is_natural|greater_than[0]'
										 ),
									 ),

			  'services_add' => array(				
								  
									
									    array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),

									   /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|is_unique[posts.post_slug]|callback_slug_check'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|is_unique[posts.post_title]'
										 ),

										/*array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_edit'
										 ),*/
									
								),

			  'services_edit' => array(	  
									
										array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),

									    /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|callback_slug_check_edit'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|callback_slug_check_edit'
										),

										/*array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_edit'
										 ),*/
									
								),

		   

			  'pages_add' => array(				
								  
									
										array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),

									    /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|callback_slug_check'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|is_unique[posts.post_title]'
										 ),
									
								),	
							
			  'page_edit' => array(												  									
										
										array(
											'field' => 'post_content',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),
										/*array(
											'field' => 'blog_tagid',
											'label' => 'tag',
											'rules' => 'trim|required'
										 ),*/

									    /*array(
											'field' => 'post_slug',
											'label' => 'Slug',
											'rules' =>  'trim|required|callback_slug_check_edit'
										 ),*/

										array(
											'field' => 'post_title',
											'label' => 'Title',
											'rules' =>  'trim|required|callback_slug_check_edit'
										 ),
									
								),

			  'blogs_add' => array(				
								  
										array(
											'field' => 'blog_category',
											'label' => 'category',
											'rules' => 'trim|required'
										 ),
										array(
											'field' => 'blog_tagid',
											'label' => 'tag',
											'rules' => 'trim|required'
										 ),

										array(
											'field' => 'blog_style',
											'label' => 'image style',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'blog_title',
											'label' => 'title',
											'rules' =>  'trim|required|is_unique[blogs.blog_title]'
										 ),

									   array(
											'field' => 'blog_created',
											'label' => 'date',
											'rules' => 'trim|required'
										 ),

									   array(
											'field' => 'blog_description',
											'label' => 'Content',
											'rules' =>  'trim|required'
										 ),
                                       
                                        array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_add'
										 ),


											
									
								),


			 	  'blogs_edit' => array(				
								  
									
									    array(
											'field' => 'blog_category',
											'label' => 'category',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'blog_tagid',
											'label' => 'tag',
											'rules' => 'trim|required'
										 ),

										array(
											'field' => 'blog_style',
											'label' => 'image style',
											'rules' => 'trim|required'
										 ),
									    array(
											'field' => 'blog_title',
											'label' => 'title',
											'rules' =>  'trim|required|callback_check_blogtitle'
										 ),
									   array(
											'field' => 'blog_created',
											'label' => 'date',
											'rules' => 'trim|required'
										 ),

									   array(
											'field' => 'blog_description',
											'label' => 'content',
											'rules' => 'trim|required'
										 ),
                                       
                                        array(
											'field' => 'features_image',
											'label' => 'image',
											'rules' => 'trim|callback_features_image_check_edit'
										 ),


											
									
								),



			  'editmyprofile' => array(				
								  
									
									array(
											'field' => 'first_name',
											'label' => 'First Name',
											'rules' =>  'trim|required'
										 ),

									   array(
											'field' => 'last_name',
											'label' => 'Last Name',
											'rules' =>  'trim|required'
										 ),

									     array(
											'field' => 'email',
											'label' => 'Email',
											'rules' =>  'trim|required|valid_email'
										 ),

											
									
								),

			
			  'registration' => array(				
								  
									
									    array(
											'field' => 'fname',
											'label' => 'first name',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'lname',
											'label' => 'last name',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'abn',
											'label' => 'ABN',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'email',
											'label' => 'email',
											'rules' =>  'trim|required|valid_email|is_unique[users.email]'
										 ),


										array(
											'field' => 'pwd',
											'label' => 'password',
											'rules' => 'trim|required|min_length[8]'
										 ),


										array(
											'field' => 'cpwd',
											'label' => 'confirm password',
											'rules' => 'trim|required|min_length[8]|matches[pwd]'
										 ),

										array(
											'field' => 'check_term',
											'label' => 'term & conditions',
											'rules' => 'trim|required'
										 ),
										
									
								),
				
				'user_password' => array(				
								  
									
									    array(
											'field' => 'pwd',
											'label' => 'current password',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'npwd',
											'label' => 'new password',
											'rules' => 'trim|required|min_length[8]'
										 ),

									    array(
											'field' => 'cnpwd',
											'label' => 're-enter new password',
											'rules' => 'trim|required|min_length[8]|matches[npwd]'
										 ),	
								),

				'change_password' => array(												  

									    array(
											'field' => 'user_id',
											'label' => 'user id',
											'rules' => 'trim|required'
										 ),

									    array(
											'field' => 'npwd',
											'label' => 'new password',
											'rules' => 'trim|required|min_length[8]'
										 ),

									    array(
											'field' => 'cnpwd',
											'label' => 're-enter new password',
											'rules' => 'trim|required|min_length[8]|matches[npwd]'
										 ),	
								),

				'customer'=>array(
										array(
												'field' => 'email',
												'label' => 'Email',
												'rules' => 'trim|required|valid_email'
											),
										array(
												'field' => 'pwd',
												'label' => 'Password',
												'rules' => 'trim|required'
											)	
									),

				'forget_password'=>array(

										array(
												'field' => 'email',
												'label' => 'Email',
												'rules' => 'trim|required|valid_email'
											),

										),



					'blog_comment'=>array(
						
						array(
								'field' => 'comments',
								'label' => 'Comment',
								'rules' => 'trim|required'
							)
										
					),




			 'products_add_simple'=>array(
						
						array(
								'field' => 'title',
								'label' => 'title',
								'rules' => 'trim|required|is_unique[products.title]'
							),
					    array(
								'field' => 'short_description',
								'label' => 'short description',
								'rules' => 'trim|required'
							),
					    array(
								'field' => 'description',
								'label' => 'description',
								'rules' => 'trim'
							),
					    array(
								'field' => 'price',
								'label' => 'Price',
								'rules' => 'trim|required'
							),

					    array(
								'field' => 'bar_code',
								'label' => 'bar code',
								'rules' => 'trim|required|callback_check_barcode'
							),				
					),


			'products_add_variation'=>array(
						
											array(
													'field' => 'title',
													'label' => 'title',
													'rules' => 'trim|required|is_unique[products.title]'
												),
										    /*array(
													'field' => 'slug',
													'label' => 'Slug',
													'rules' => 'trim|required|is_unique[products.slug]'
												),*/
										    array(
													'field' => 'description',
													'label' => 'Description',
													'rules' => 'trim'
												),
										    array(
													'field' => 'short_description',
													'label' => 'short description',
													'rules' => 'trim|required'
												),
										    /*array(
													'field' => 'price',
													'label' => 'Price',
													'rules' => 'trim|required'
												),*/
										   				
										),

				'attributes_add'=>array(
						
											array(
													'field' => 'attribute',
													'label' => 'Attribute',
													'rules' => 'trim|required|is_unique[product_attributes.attribute]'
												)
															
										),


				'attributes_edit'=>array(
						
											array(
													'field' => 'attribute',
													'label' => 'Attribute',
													'rules' => 'trim|required|callback_check_updateattributes'
												)
															
										),

				'promocode_add'=>array(
						
											array(
													'field' => 'applied_on[]',
													'label' => 'applied on',
													'rules' => 'required'
												),

											array(
													'field' => 'code',
													'label' => 'code',
													'rules' => 'trim|required|alpha_dash|is_unique[promo_code.code]'
												),
											array(
													'field' => 'start_date',
													'label' => 'start date',
													'rules' => 'trim|required'
												),
											array(
													'field' => 'end_date',
													'label' => 'end date',
													'rules' => 'trim|required'
												),
											array(
													'field' => 'min_amount',
													'label' => 'minimum amount',
													'rules' => 'trim|required|numeric|greater_than[0]'
												),
											array(
													'field' => 'discount',
													'label' => 'discount',
													'rules' => 'trim|required|numeric|greater_than[0]|callback_check_percentage'
												),
											array(
													'field' => 'discount_type',
													'label' => 'type',
													'rules' => 'trim|required'
												),

															
										),


				'promocode_edit'=>array(
						
											array(
													'field' => 'applied_on[]',
													'label' => 'applied on',
													'rules' => 'required'
												),

											array(
													'field' => 'code',
													'label' => 'code',
													'rules' => 'trim|required|alpha_dash|callback_check_updatepromocode'
												),
											array(
													'field' => 'start_date',
													'label' => 'start date',
													'rules' => 'trim|required'
												),
											array(
													'field' => 'end_date',
													'label' => 'end date',
													'rules' => 'trim|required'
												),
											array(
													'field' => 'min_amount',
													'label' => 'minimum amount',
													'rules' => 'trim|required|numeric|greater_than[0]'
												),
											array(
													'field' => 'discount',
													'label' => 'minimum amount',
													'rules' => 'trim|required|numeric|greater_than[0]|callback_check_percentage'
												),
											array(
													'field' => 'discount_type',
													'label' => 'type',
													'rules' => 'trim|required'
												),			
										),



			 	'configure_terms_add' =>array(
						
											array(
													'field' => 'nameadd[]',
													'label' => 'Name',
													'rules' => 'trim|required'
												)
															
										),
			 	'configure_terms_edit'=>array(
						
											array(
													'field' => 'name',
													'label' => 'Name',
													'rules' => 'trim|required|callback_check_configure_terms'
												)
															
										),

			 	'products_add_one_simple'=>array(
						
											array(
													'field' => 'title',
													'label' => 'title',
													'rules' => 'trim|required|callback_check_updateproduct'
												),
										    /*array(
													'field' => 'bar_code',
													'label' => 'bar code',
													'rules' => 'trim|required'
												), check_updateproduct*/
										    array(
													'field' => 'description',
													'label' => 'Description',
													'rules' => 'trim'
												),
										    
										    array(
													'field' => 'short_description',
													'label' => 'short description',
													'rules' => 'trim|required'
												),
										    
										    array(
													'field' => 'price',
													'label' => 'Price',
													'rules' => 'trim|required'
												),
											
											array(
													'field' => 'bar_code',
													'label' => 'bar code',
													'rules' => 'trim|required|callback_check_edit_barcode'
												),				
										),



				'products_add_one_variation'=>array(
										
											array(
													'field' => 'title',
													'label' => 'title',
													'rules' => 'trim|required|callback_check_updateproduct'
												),
										    /*array(
													'field' => 'slug',
													'label' => 'Slug',
													'rules' => 'trim|required'
												),*/
											array(
													'field' => 'short_description',
													'label' => 'short description',
													'rules' => 'trim|required'
												),

											array(
													'field' => 'description',
													'label' => 'Description',
													'rules' => 'trim'
												),

											/*array(
													'field' => 'price',
													'label' => 'Price',
													'rules' => 'trim|required'
												),*/										   															
										),

       
         'gallery_add' => array(				
								  
									
									array(
											'field' => 'gallery_title',
											'label' => 'Title',
											'rules' =>  'trim|required'
										 ),

                                    array(
										'field' => 'features_image',
										'label' => 'Image',
										'rules' =>  'trim|callback_features_image_check_add'
									 ),

								),

           'gallery_edit' => array(												  
									
									array(
											'field' => 'gallery_title',
											'label' => 'Title',
											'rules' =>  'trim|required'
										 ),

                                        array(
											'field' => 'features_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_features_image_check_edit'
										 ),


											
									
								),

           'traning_category_add'=>array(
						
									array(
											'field' => 'name',
											'label' => 'Name',
											'rules' => 'trim|required|is_unique[traning_category.name]'
										)
													
								),


			'traning_category_edit'=>array(
						
									array(
											'field' => 'name',
											'label' => 'Name',
											'rules' => 'trim|required|callback_check_edit_traning_cat'
										)
													
								),

			'member_category_add'=>array(
						
									array(
											'field' => 'name',
											'label' => 'Name',
											'rules' => 'trim|required|is_unique[membership_category.name]'
										)
													
								),

			'member_category_edit'=>array(
						
									array(
											'field' => 'name',
											'label' => 'Name',
											'rules' => 'trim|required|callback_check_edit_mamber_cat'
										)
													
								),





           'plans_add'	=>      array(
						
									array(
											'field' => 'title',
											'label' => 'Title',
											'rules' => 'trim|required|is_unique[plans.title]'
										),
									array(
										'field' => 'duration',
										'label' => 'Duration',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'amount',
										'label' => 'Amount',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'description',
										'label' => 'Description',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'features_image',
										'label' => 'Image',
										'rules' =>  'trim|callback_features_image_check_add'
									),
										
					),

		    'plans_edit'=>array(
									
									array(
											'field' => 'title',
											'label' => 'Title',
											'rules' => 'trim|required|callback_check_edit_plans'
										),
									array(
										'field' => 'duration',
										'label' => 'Duration',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'amount',
										'label' => 'Amount',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'description',
										'label' => 'Description',
										'rules' => 'trim|required'
									),
									 array(
										'field' => 'features_image',
										'label' => 'Image',
										'rules' =>  'trim|callback_features_image_check_edit'
									 ),
										
					),


		    'update_detail_by_user'=>array(
									
									array(
										'field' => 'first_name',
										'label' => 'first name',
										'rules' => 'trim|required'
										),
									array(
										'field' => 'last_name',
										'label' => 'last name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									/*array(
										'field' => 'county',
										'label' => 'county',
										'rules' => 'trim|required'
									),*/
									array(
										'field' => 'mobile',
										'label' => 'phone no.',
										'rules' => 'trim|required|min_length[10]'
									),
									array(
										'field' => 's_first_name',
										'label' => 'first name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_last_name',
										'label' => 'last name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email'
									),
									array(
										'field' => 's_address',
										'label' => 'address',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_city',
										'label' => 'city',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_state',
										'label' => 'state',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									/*array(
										'field' => 's_county',
										'label' => 'county',
										'rules' => 'trim|required'
									),*/
									array(
										'field' => 's_mobile',
										'label' => 'phone no.',
										'rules' => 'trim|required|min_length[10]'
									),
										
					),

			'contact_detail_at_buying'=> array(

									array(
										'field' => 'first_name',
										'label' => 'first name',
										'rules' => 'trim|required'
									),
									array(
										'field'	=> 'last_name',
										'label'	=> 'last name',
										'rules'	=> 'trim|required'
									),
									array(
										'field'	=> 'email',
										'label' => 'email',
										'rules'	=> 'trim|required|valid_email'
									),
									array(
										'field'	=> 'contact',
										'label' => 'contact number',
										'rules'	=> 'trim|required|min_length[10]'
									),	

					), 

			'membership_buyer_detail'=>	array(
					array(
						'field' => 'first_name',
						'label' => 'first name',
						'rules' => 'trim|required'
					),
					array(
						'field'	=> 'last_name',
						'label'	=> 'last name',
						'rules'	=> 'trim|required'
					),
					array(
						'field'	=> 'email',
						'label' => 'email',
						'rules'	=> 'trim|required|valid_email'
					),
					array(
						'field'	=> 'contact',
						'label' => 'contact number',
						'rules'	=> 'trim|required|min_length[10]'
					),	
				),
			
			'update_detail_at_buying'=>array(
									
									array(
										'field' => 'first_name',
										'label' => 'first name',
										'rules' => 'trim|required'
										),
									array(
										'field' => 'last_name',
										'label' => 'last name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									/*array(
										'field' => 'county',
										'label' => 'county',
										'rules' => 'trim|required'
									),*/
									array(
										'field' => 'mobile',
										'label' => 'phone no.',
										'rules' => 'trim|required|min_length[10]'
									),
									array(
										'field' => 's_first_name',
										'label' => 'first name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_last_name',
										'label' => 'last name',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email'
									),
									array(
										'field' => 's_address',
										'label' => 'address',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_city',
										'label' => 'city',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_state',
										'label' => 'state',
										'rules' => 'trim|required'
									),
									array(
										'field' => 's_zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									/*array(
										'field' => 's_county',
										'label' => 'county',
										'rules' => 'trim|required'
									),*/
									array(
										'field' => 's_mobile',
										'label' => 'phone no.',
										'rules' => 'trim|required|min_length[10]'
									),
										
					),

				'user_add' => array(												  								
								    array(
										'field' => 'first_name',
										'label' => 'first Name',	
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'last_name',
										'label' => 'last Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email|is_unique[users.email]'
									 ),

								    array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'password',
										'label' => 'password',
										'rules' => 'trim|required|min_length[8]'
									 ),

									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									array(
										'field' => 'mobile',
										'label' => 'phone number',
										'rules' => 'trim|required|min_length[10]'
									),

									array(
										'field' => 's_first_name',
										'label' => 'first Name',	
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 's_last_name',
										'label' => 'last Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 's_email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email'
									 ),

								    array(
										'field' => 's_address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_city',
										'label' => 'city',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									array(
										'field' => 's_mobile',
										'label' => 'phone number',
										'rules' => 'trim|required|min_length[10]'
									),								
								
							),
				'user_edit' => array(												  								
								    array(
										'field' => 'first_name',
										'label' => 'first Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'last_name',
										'label' => 'last Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email|callback_check_user_email'
									 ),

								    array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									array(
										'field' => 'mobile',
										'label' => 'phone number',
										'rules' => 'trim|required|min_length[10]'
									),

									array(
										'field' => 's_first_name',
										'label' => 'first Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 's_last_name',
										'label' => 'last Name',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 's_email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email'
									 ),

								    array(
										'field' => 's_address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_city',
										'label' => 'city',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 's_zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									array(
										'field' => 's_mobile',
										'label' => 'phone number',
										'rules' => 'trim|required|min_length[10]'
									),								
								
							),
			'client_add' => array(	
									array(
										'field' => 'cliend_kind',
										'label' => 'distributor type',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'title',
										'label' => 'name',
										'rules' => 'trim|required'
									 ), 

								    array(
										'field' => 'user_name',
										'label' => 'contact person',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'paypal',
										'label' => 'paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The paypal field must contain a valid address.',
										                ),
									 ),

								    array(
										'field' => 'email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email|is_unique[users.email]'
									 ),

								    array(
										'field' => 'email_2',
										'label' => 'alternate email',
										'rules' => 'trim|callback_check_alternate_email'
									 ),

									array(
										'field' => 'mobile',
										'label' => 'contact number',
										'rules' => 'trim|required|min_length[10]'
									),

									array(
										'field' => 'mobile_2',
										'label' => 'alternate contact number',
										'rules' => 'trim'
									),

								    array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),

									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
										),

									array(
										'field' => 'charity_paypal',
										'label' => 'charity paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The charity paypal field must contain a valid address.',
										                )
										),

									array(
										'field' => 'charity_percentage',
										'label' => 'charity percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),

									array(
										'field' => 'state_paypal',
										'label' => 'state manager paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The state manager paypal field must contain a valid address.',
										                )
										),

									array(
										'field' => 'state_percentage',
										'label' => 'state manager percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),

									array(
										'field' => 'lash_percentage',
										'label' => 'lash percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),

									array(
										'field' => 'password',
										'label' => 'password',
										'rules' => 'trim|required|min_length[8]'
									),
									
							),

				'client_edit' => array(

								    array(
										'field' => 'cliend_kind',
										'label' => 'distributor type',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'title',
										'label' => 'name',
										'rules' => 'trim|required'
									 ), 

								    array(
										'field' => 'user_name',
										'label' => 'contact person',
										'rules' => 'trim|required'
									 ),

								    array(
										'field' => 'paypal',
										'label' => 'paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The paypal field must contain a valid address.',
										                )
									 ),

								    array(
										'field' => 'email',
										'label' => 'email',
										'rules' => 'trim|required|valid_email|callback_check_user_email'
									 ),

								    array(
										'field' => 'email_2',
										'label' => 'alternate email',
										'rules' => 'trim|callback_check_alternate_email'
									 ),

									array(
										'field' => 'mobile',
										'label' => 'contact number',
										'rules' => 'trim|required|min_length[10]'
									),

									array(
										'field' => 'mobile_2',
										'label' => 'alternate contact number',
										'rules' => 'trim'
									),

								    array(
										'field' => 'address',
										'label' => 'address',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'zip',
										'label' => 'postal code',
										'rules' => 'trim|required|min_length[4]'
									),
									
									array(
										'field' => 'state',
										'label' => 'state',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'city',
										'label' => 'city',
										'rules' => 'trim|required'
									),

									array(
										'field' => 'charity_paypal',
										'label' => 'charity paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The charity paypal field must contain a valid address.',
										                )
										),

									array(
										'field' => 'charity_percentage',
										'label' => 'charity percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),

									array(
										'field' => 'state_paypal',
										'label' => 'state manager paypal',
										'rules' => 'trim|required|valid_email',
										'errors' => array(
										                   'valid_email' => 'The state manager paypal field must contain a valid address.',
										                )
										),

									array(
										'field' => 'state_percentage',
										'label' => 'state manager percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),

									array(
										'field' => 'lash_percentage',
										'label' => 'lash percentage',
										'rules' => 'trim|required|greater_than_equal_to[0]'
										),
							),

			'about_add' => array(				
								  									
								   array(
										'field' => 'title',
										'label' => 'title',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'content',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'features_image',
										'label' => 'Photo',
										'rules' =>  'trim|callback_about_image_check_add'
									 ), 
									
								),



			  'about_edit' => array(				
								  
									
									array(
										'field' => 'title',
										'label' => 'title',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'content',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'features_image',
										'label' => 'Photo',
										'rules' =>  'trim|callback_about_image_check_edit'
									 ), 
									
								),

			  'team_add' => array(				
								  									
								  	array(
										'field' => 'title',
										'label' => 'name',
										'rules' => 'trim|required'
									 ),

								  	array(
										'field' => 'post',
										'label' => 'designation',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'bio',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'features_image',
										'label' => 'Photo',
										'rules' =>  'trim|callback_about_image_check_add'
									 ), 
									
								),



			  'team_edit' => array(				
								  
									
									array(
										'field' => 'title',
										'label' => 'name',
										'rules' => 'trim|required'
									 ),

								  	array(
										'field' => 'post',
										'label' => 'designation',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'bio',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'features_image',
										'label' => 'Photo',
										'rules' =>  'trim|callback_about_image_check_edit'
									 ), 
									
								),

			  	'charity_add' => array(				
								  									
								  	array(
										'field' => 'title',
										'label' => 'title',
										'rules' => 'trim|required'
									 ),

								  	array(
										'field' => 'short_content',
										'label' => 'short content',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'content',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'date',
										'label' => 'event date',
										'rules' => 'trim|required'
									 ), 
									
								),



			  'charity_edit' => array(				
								  
									
									array(
										'field' => 'title',
										'label' => 'title',
										'rules' => 'trim|required'
									 ),

								  	array(
										'field' => 'short_content',
										'label' => 'short content',
										'rules' => 'trim|required'
									 ),

									array(
										'field' => 'content',
										'label' => 'content',
										'rules' => 'trim|required'
									 ), 

									array(
										'field' => 'date',
										'label' => 'event date',
										'rules' => 'trim|required'
									 ), 
									
								),

			'services_category_add' => array(				
								  
									array(
											'field' => 'name',
											'label' => 'name',
											'rules' =>  'trim|required|callback_check_updatecategory'
										 ),
									array(
											'field' => 'detail',
											'label' => 'short description',
											'rules' =>  'trim|required'
										 ),

									array(
										'field' => 'service_image',
										'label' => 'Image',
										'rules' =>  'trim|callback_services_image_check_add'
									 ),
								),
		
			'services_category_edit' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updatecategory'
											 ),
										array(
											'field' => 'detail',
											'label' => 'short description',
											'rules' =>  'trim|required'
										 ),

										array(
											'field' => 'service_image',
											'label' => 'Image',
											'rules' =>  'trim|callback_services_image_check_edit'
										 ),
									),	

			'services_sub_category_add' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updateSubCategory'
											 ),
									),
			
			'services_sub_category_edit' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updateSubCategory'
											 ),
									),

			'services_last_category_add' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updateLastCategory'
											 ),
									),
			
			'services_last_category_edit' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updateLastCategory'
											 ),
									),

			'services_artist_add' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|is_unique[services_artist.name]'
											 ),
										array(
												'field' => 'description',
												'label' => 'short description',
												'rules' =>  'trim|required'
											 ),

										array(
												'field' => 'service_image',
												'label' => 'image',
												'rules' =>  'trim|callback_services_image_check_add'
											 ),
										array(
												'field' => 'timeStart1',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart2',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart3',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart4',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart5',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart6',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeStart7',
												'label' => 'start time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd1',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd2',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd3',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd4',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd5',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd6',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										array(
												'field' => 'timeEnd7',
												'label' => 'end time',
												'rules' => 'trim|required|min_length[4]'
											 ),
										
									),
			
			'services_artist_edit' => array(				
									  
										array(
												'field' => 'name',
												'label' => 'name',
												'rules' => 'trim|required|callback_check_updateArtist'
											 ),
										array(
												'field' => 'description',
												'label' => 'short description',
												'rules' =>  'trim|required'
											 ),

										array(
												'field' => 'service_image',
												'label' => 'image',
												'rules' =>  'trim|callback_services_image_check_edit'
											 ),
										),
			
			'services_working_days_edit' => array(				
											array(
													'field' => 'timeStart1',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart2',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart3',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart4',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart5',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart6',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeStart7',
													'label' => 'start time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd1',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd2',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd3',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd4',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd5',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd6',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
											array(
													'field' => 'timeEnd7',
													'label' => 'end time',
													'rules' => 'trim|required|min_length[4]'
												 ),
									),	
		'discount_add'	=>      array(
									array(
										'field' => 'plan_id',
										'label' => 'Plan',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'discount_code',
										'label' => 'Discount Code',
										'rules' => 'trim|required|min_length[8]|alpha_numeric|is_unique[plan_discount_code.discount_code]'
									),
									array(
										'field' => 'user_id',
										'label' => 'User',
										'rules' => 'trim'
									),
									array(
										'field' => 'start_date',
										'label' => 'Start Date',
										'rules' => 'trim|required'
									),
									/*array(
										'field' => 'end_date',
										'label' => 'End Date',
										'rules' => 'trim|required'
									),*/
										
					), 
		'discount_edit'	=>      array(
									array(
										'field' => 'plan_id',
										'label' => 'Plan',
										'rules' => 'trim|required'
									),
									array(
										'field' => 'discount_code',
										'label' => 'Discount Code',
										'rules' => 'trim|required|min_length[8]|alpha_numeric|callback_check_edit_discount_code'
									),
									array(
										'field' => 'user_id',
										'label' => 'User',
										'rules' => 'trim'
									),
									array(
										'field' => 'start_date',
										'label' => 'Start Date',
										'rules' => 'trim|required'
									),
									/*array(
										'field' => 'end_date',
										'label' => 'End Date',
										'rules' => 'trim|required'
									),*/
										
					), 
		'user_membership'	=> array(
									array(
										'field' => 'discount_code',
										'label' => 'Discount Code',
										'rules' => 'trim|required|callback_validate_discount_code'
									),
					), 
																
	)
?>