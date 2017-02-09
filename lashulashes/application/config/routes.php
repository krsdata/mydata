<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'website';
$route['404_override'] = 'page';
$route['translate_uri_dashes'] = FALSE;

$route['website'] = "website";
$route['website/(:any)'] = "website/$1";
$route['website/(:any)/(:any)'] = "website/$1/$2";

$route['distributor'] = "distributor";
$route['distributor/(:any)'] = "distributor/$1";
$route['distributor/(:any)/(:any)'] = "distributor/$1/$2";


$route['backend'] = "backend/superadmin";
$route['backend/(:any)'] = "backend/$1";
$route['backend/(:any)/(:any)'] = "backend/$1/$2";
$route['backend/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3";
$route['backend/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4";
$route['backend/(:any)/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4/$5";
$route['backend/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4/$5/$6";
$route['backend/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4/$5/$6/$7";



$route['contact'] = "contact";

$route['contact/(:any)'] = "contact/$1";

$route['contact/(:any)/(:any)'] = "contact/$1/$2";

$route['contact/(:any)/(:any)/(:any)'] = "contact/$1/$2/$3";

$route['contact/(:any)/(:any)/(:any)/(:any)'] = "contact/$1/$2/$3/$4";



$route['training'] = "training";

$route['training/(:any)'] = "training/$1";

$route['training/(:any)/(:any)'] = "training/$1/$2";

$route['training/(:any)/(:any)/(:any)'] = "training/$1/$2/$3";

$route['training/(:any)/(:any)/(:any)/(:any)'] = "training/$1/$2/$3/$4";


$route['blog'] = "blog";

$route['blog/(:any)'] = "blog/$1";

$route['blog/(:any)/(:any)'] = "blog/$1/$2";

$route['blog/(:any)/(:any)/(:any)'] = "blog/$1/$2/$3";

$route['blog/(:any)/(:any)/(:any)/(:any)'] = "blog/$1/$2/$3/$4";

$route['blog/(:any)/(:any)/(:any)/(:any)/(:any)'] = "blog/$1/$2/$3/$4/$5";


$route['news'] = "news";

$route['news/(:any)'] = "news/$1";

$route['news/(:any)/(:any)'] = "news/$1/$2";

$route['news/(:any)/(:any)/(:any)'] = "news/$1/$2/$3";

$route['news/(:any)/(:any)/(:any)/(:any)'] = "news/$1/$2/$3/$4";


$route['testimonials'] = "testimonials";

$route['testimonials/(:any)'] = "testimonials/$1";

$route['testimonials/(:any)/(:any)'] = "testimonials/$1/$2";



$route['service'] = "service";

$route['service/(:any)'] = "service/$1";

$route['service/(:any)/(:any)'] = "service/$1/$2";

$route['service/(:any)/(:any)/(:any)'] = "service/$1/$2/$3";

$route['service/(:any)/(:any)/(:any)/(:any)'] = "service/$1/$2/$3/$4";


$route['elfinders'] = "elfinders";

$route['elfinders/(:any)'] = "elfinders/$1";

$route['elfinders/(:any)/(:any)'] = "elfinders/$1/$2";

$route['emailtemplates'] = "emailtemplates";

$route['emailtemplates/(:any)'] = "emailtemplates/$1";

$route['emailtemplates/(:any)/(:any)'] = "emailtemplates/$1/$2";



$route['product'] = "product";

$route['product/(:any)'] = "product/$1";

$route['product/(:any)/(:any)'] = "product/$1/$2";

$route['product/(:any)/(:any)/(:any)'] = "product/$1/$2/$3";

$route['product/(:any)/(:any)/(:any)/(:any)'] = "product/$1/$2/$3/$4";



$route['membership'] = "membership";

$route['membership/(:any)'] = "membership/$1";

$route['membership/(:any)/(:any)'] = "membership/$1/$2";

$route['membership/(:any)/(:any)/(:any)'] = "membership/$1/$2/$3";

$route['membership/(:any)/(:any)/(:any)/(:any)'] = "membership/$1/$2/$3/$4";


$route['cart'] = "cart";

$route['cart/(:any)'] = "cart/$1";

$route['cart/(:any)/(:any)'] = "cart/$1/$2";

$route['cart/(:any)/(:any)/(:any)'] = "cart/$1/$2/$3";

$route['cart/(:any)/(:any)/(:any)/(:any)'] = "cart/$1/$2/$3/$4";



$route['(:any)'] = "page";
$route['(:any)/(:any)'] = "page/index/$1";

$route['(:any)/(:any)/(:any)'] = "page/index/$1/$2";

$route['(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3";

$route['(:any)/(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3/$4";

$route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3/$4/$5";

$route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3/$4/$5/$6";

$route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3/$4/$5/$6/$7";

$route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "page/index/$1/$2/$3/$4/$5/$6/$7/$8";

