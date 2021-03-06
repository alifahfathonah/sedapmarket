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
//Transcation
$route["transcation/detail/edit/(:num)/(:num)"] 	= "po_controller/edit_transcation_detail/$1/$2";
$route["transcation/detail/add/(:num)"] 			= "po_controller/add_transcation_detail/$1";
$route["transcation/detail/list/(:num)"] 			= "po_controller/get_transdetail_list/$1";
$route["transcation/detail/list"] 					= "po_controller/get_transdetail_list";
$route["transcation/edit/(:num)"] 					= "po_controller/edit_transcation/$1";
$route["transcation/add"] 							= "po_controller/add_transcation";
$route["transcation/list/(:num)"] 					= "po_controller/get_transcation_list/$1";
$route["transcation/list"] 							= "po_controller/get_transcation_list";

//PO
$route["po/detail/edit/(:num)/(:num)"] 				= "po_controller/edit_po_detail/$1/$2";
$route["po/detail/add/(:num)"] 						= "po_controller/add_po_detail/$1";
$route["po/detail/list/(:num)"] 					= "po_controller/get_podetail_list/$1";
$route["po/detail/list"] 							= "po_controller/get_podetail_list";
$route["po/edit/(:num)"] 							= "po_controller/edit_po/$1";
$route["po/add"] 									= "po_controller/add_po";
$route["po/list/(:num)"] 							= "po_controller/get_po_list/$1";
$route["po/list"] 									= "po_controller/get_po_list";


//Set Price
$route["customer/browse/product/(:num)"] 			= "master_controller/get_product_list/$1";	
$route["customer/price/edit/(:num)/(:num)"] 		= "master_controller/edit_setprice/$1/$2";
$route["customer/price/add/(:num)"] 				= "master_controller/add_setprice/$1";
$route["customer/price/list/(:num)"] 				= "master_controller/get_setprice_list/$1";
$route["customer/price/list"] 						= "master_controller/get_setprice_list";

//Production
$route["production/edit/(:num)"] 					= "master_controller/edit_production/$1";
$route["production/add"] 							= "master_controller/add_production";
$route["production/list/(:num)"] 					= "master_controller/get_production_list/$1";
$route["production/list"] 							= "master_controller/get_production_list";

//Shipping
$route["shipper/edit/(:num)"] 						= "master_controller/edit_shipper/$1";
$route["shipper/add"] 								= "master_controller/add_shipper";
$route["shipper/list/(:num)"] 				= "master_controller/get_shipper_list/$1";
$route["shipper/list"] 						= "master_controller/get_shipper_list";

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
$route["browse/ship/(:num)"]				= "po_controller/get_ship_browse/$1";	
$route["browse/ship"]						= "po_controller/get_ship_browse";	
$route["browse/customers/(:num)"]			= "po_controller/get_cust_browse/$1";	
$route["browse/customers"]					= "po_controller/get_cust_browse";	
$route["browse/product/(:num)/(:num)"] 		= "master_controller/get_product_list/$1/$2";	
$route["browse/product/(:num)"] 			= "master_controller/get_product_list/$1";	
$route["setup"] 							= "option_controller/edit_setup";
$route["profile/edit"] 						= "user_controller/editprofile";
$route["home"] 								= "user_controller/home";
$route["login"] 							= "user_controller/login";
$route["logout"] 							= "user_controller/logout";
$route['default_controller'] 				= "user_controller/home";
$route['404_override'] 						= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */