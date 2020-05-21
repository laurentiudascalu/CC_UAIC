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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['ajax']='ajax';
$route['ajax/(:any)']='ajax';
$route['ajax/(:any)/(:any)']='ajax';
$route['ajax/(:any)/(:any)/(:any)']='ajax';

$route['update']='update';
$route['update/upload']='update/upload';

$route['cron'] = 'cron';
$route['cron/(:any)'] = 'cron/index';
$route['cron/(:any)/(:any)'] = 'cron/index';

$route['test'] = 'test';
$route['test/(:any)'] = 'test/index';
$route['test/(:any)/(:any)'] = 'test/index';

$route['callbackmicrosoft'] = 'login/callbackmicrosoft';
$route['callbackgoogle'] = 'login/callbackgoogle';
$route['logout'] = 'login/delogare';
$route['login/p'] = 'login/p';
$route['recuperare-parola'] = 'login/recuperareParola';
$route['cont-nou'] = 'login/contNou';

$route['categorii'] = 'site/categorii';
$route['categorie/(:any)']='site/categorie/$1';

$route['contul-tau'] = 'site/contulTau';
$route['p'] = 'site/p';
$route['cauta/(:any)'] = 'site/index/$1';
$route['login'] = 'login';
$route['login/p'] = 'login/p';
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
