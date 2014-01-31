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

//Set Price
$route["customer/price/edit/(:num)"] 		= "master_controller/edit_setprice/$1";
$route["customer/price/add"] 				= "master_controller/add_setprice";
$route["customer/price/list/(:num)"] 		= "master_controller/get_setprice_list/$1";
$route["customer/price/list"] 				= "master_controller/get_setprice_list";

//Region
$route["region/edit/(:num)"] 				= "master_controller/edit_region/$1";
$route["region/add"] 						= "master_controller/add_region";
$route["region/list/(:num)"] 				= "master_controller/get_regions_list/$1";
$route["region/list"] 						= "master_controller/get_regions_list";

//Unit
$route["unit/edit/(:num)"] 					= "master_controller/edit_unit/$1";
$route["unit/add"] 							= "master_controller/add_unit";
$route["unit/list/(:num)"] 					= "master_controller/get_units_list/$1";
$route["unit/list"] 						= "master_controller/get_units_list";

//Products
$route["products/edit/(:num)"] 				= "master_controller/edit_product/$1";
$route["products/add"] 						= "master_controller/add_product";
$route["products/list/(:num)"] 				= "master_controller/get_products_list/$1";
$route["products/list"] 					= "master_controller/get_products_list";

//Category
$route["category/edit/(:num)"] 				= "master_controller/edit_category/$1";
$route["category/add"] 						= "master_controller/add_category";
$route["category/list/(:num)"] 				= "master_controller/get_category_list/$1";
$route["category/list"] 					= "master_controller/get_category_list";

//Customer
$route["customer/edit/(:num)"] 				= "master_controller/edit_customer/$1";
$route["customer/add"] 						= "master_controller/add_customer";
$route["customer/list/(:num)"] 				= "master_controller/get_customers_list/$1";
$route["customer/list"] 					= "master_controller/get_customers_list";

//General
$route["setup"] 							= "option_controller/edit_setup";
$route["profile/edit"] 						= "user_controller/editprofile";
$route["home"] 								= "user_controller/home";
$route["login"] 							= "user_controller/login";
$route["logout"] 							= "user_controller/logout";
$route['default_controller'] 				= "user_controller/home";
$route['404_override'] 						= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */