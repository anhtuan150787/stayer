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

$route['default_controller'] = "frontend/index";
$route['404_override'] = '';

/*
 *	Backend
 */
$route['admin'] = "backend/index";
$route['admin/(:any)'] = "backend/$1";

/*
 *	Partner
 */
$route['partner/(:any)'] = "partner/$1";

/*
 *	Request
 */
$route['request/(:any)'] = "frontend/request/$1";

/*
 *	Hotel search
 */
$route['s/(:any)'] = "frontend/hotel/index/$1";

/*
 *	Hotel search default
 */
$route['ss/(:any)'] = "frontend/hotel/search/$1";

/*
 *	Hotel detail
 */
$route['h/(:any)-(:num).html'] = "frontend/hotel/detail/id/$2";

/*
 * Page
 */
$route['p/(:any)'] = "frontend/page/index/$1";

/*
 * Cam nang
 */
$route['hb/(:any)-(:num).html'] = "frontend/handbook/detail/id/$2";

$route['hb/(:any)'] = "frontend/handbook/index";

/*
 *	Tour detail
 */
$route['tour/(:any)-(:num).html'] = "frontend/tour/detail/id/$2";

/*
 * Tour
 */
$route['tour.html'] = "frontend/tour/index";

/*
 * Tour search
 */
$route['tour/(:any)'] = "frontend/tour/search";

/*
 *	Hotel search default
 */
$route['tour-search/(:any)'] = "frontend/tour/search_default/$1";


/*  
 *  Login
 */
$route['dang-nhap'] = "frontend/login";

/*  
 *  Loout
 */
$route['thoat'] = "frontend/login/logout";

/*  
 *  Registration
 */
$route['dang-ky'] = "frontend/registration";

/*  
 *  Forget password
 */
$route['quen-mat-khau'] = "frontend/forget_pass";

/*  
 *  Booking
 */
$route['booking'] = 'frontend/booking';
$route['booking_2'] = 'frontend/booking/step2';
$route['order_finish'] = 'frontend/booking/order_finish';

/*
 * Booking tour
 */
$route['booking-tour'] = 'frontend/booking_tour';
$route['booking-tour-2'] = 'frontend/booking_tour/step2';
$route['tour-order-finish'] = 'frontend/booking_tour/order_finish';

/* End of file routes.php */
/* Location: ./application/config/routes.php */