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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['seeder'] = 'seeder';

$route['login'] = 'auth/login';
$route['process_login'] = 'auth/process_login';
$route['auth/logout'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['auth/process_register'] = 'auth/process_register';

$route['forgot_password'] = 'auth/forgot_password';
$route['auth/process_forgot_password'] = 'auth/process_forgot_password';
$route['auth/verify_otp_reset'] = 'auth/verify_otp_reset';
$route['auth/verify_otp_reset_password'] = 'auth/verify_otp_reset_password';
$route['auth/reset_password'] = 'auth/change_password_form';
$route['auth/process_reset_password'] = 'auth/change_password';

$route['auth/verify_otp'] = 'auth/verify_otp';
$route['auth/process_otp'] = 'auth/process_otp';

$route['dashboard'] = 'dashboard/index';
$route['doctor'] = 'doctor/index';

$route['pasien'] = 'pasien/index';
$route['pasien/get_data'] = 'pasien/get_data';

$route['doctor/store'] = 'doctor/store';
$route['doctor/get_data'] = 'doctor/get_data';
$route['doctor/edit/(:num)'] = 'doctor/edit/$1';
$route['doctor/update'] = 'doctor/update';
$route['doctor/delete/(:num)'] = 'doctor/delete/$1';


$route['obat'] = 'obat/index';

$route['penyakit'] = 'penyakit/index';

$route['ruangan'] = 'ruangan/index';

$route['riwayat_berobat'] = 'riwayat_berobat/index';
$route['riwayat/store'] = 'riwayat_berobat/store';

$route['antrian'] = 'antrian/index';