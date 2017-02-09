<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "store";
$route['404_override'] = 'store/error_page';

$route['superadmin'] = "superadmin";
$route['superadmin/(:any)'] = "superadmin/$1";
$route['superadmin/(:any)/(:any)'] = "superadmin/$1/$2";
$route['superadmin/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3";
$route['superadmin/(:any)/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3/$4";
$route['superadmin/(:any)/(:any)/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3/$4/$5";
$route['superadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3/$4/$5/$6";
$route['superadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3/$4/$5/$6/$7";
$route['superadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "superadmin/$1/$2/$3/$4/$5/$6/$7/$8";

// $route['store'] = "store";
// $route['shop/(:any)'] = "store/check_link/$1";
// $route['store/(:any)'] = "store/$1";
// $route['store/(:any)/(:any)'] = "store/$1/$2";
// $route['store/(:any)/(:any)/(:any)'] = "store/$1/$2/$3";
// $route['store/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4";
// $route['store/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5";
// $route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6";
// $route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6/$7";
// $route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6/$7/$8";

$route['store'] = "store";
$route['wear_it/(:any)'] = "store/wear_it/$1";
$route['shop/(:any)'] = "store/check_link/$1";
$route['store/(:any)'] = "store/$1";
$route['store/(:any)/(:any)'] = "store/$1/$2";
$route['store/(:any)/(:any)/(:any)'] = "store/$1/$2/$3";
$route['store/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4";
$route['store/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5";
$route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6";
$route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6/$7";
$route['store/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "store/$1/$2/$3/$4/$5/$6/$7/$8";

$route['storeadmin'] = "storeadmin";
$route['storeadmin/(:any)'] = "storeadmin/$1";
$route['storeadmin/(:any)/(:any)'] = "storeadmin/$1/$2";
$route['storeadmin/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3";
$route['storeadmin/(:any)/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3/$4";
$route['storeadmin/(:any)/(:any)/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3/$4/$5";
$route['storeadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3/$4/$5/$6";
$route['storeadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3/$4/$5/$6/$7";
$route['storeadmin/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "storeadmin/$1/$2/$3/$4/$5/$6/$7/$8";

$route['user'] = "user";
$route['user/(:any)'] = "user/$1";
$route['user/(:any)/(:any)'] = "user/$1/$2";
$route['user/(:any)/(:any)/(:any)'] = "user/$1/$2/$3";
$route['user/(:any)/(:any)/(:any)/(:any)'] = "user/$1/$2/$3/$4";
$route['user/(:any)/(:any)/(:any)/(:any)/(:any)'] = "user/$1/$2/$3/$4/$5";
$route['user/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "user/$1/$2/$3/$4/$5/$6";
$route['user/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "user/$1/$2/$3/$4/$5/$6/$7";
$route['user/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "user/$1/$2/$3/$4/$5/$6/$7/$8";


/* End of file routes.php */
/* Location: ./application/config/routes.php */