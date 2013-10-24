<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
*/

// front-end
//$route['epg(/:any)?']					= 'epg/index$1';
// $route['epg/view_channels(/:num)?']		= 'epg/view_channels/index$1';
$route['epg/show(/:any)?']		= 'epg/show$1';
$route['epg/channels']		= 'epg/channel_lineup';
$route['epg/schedule(/:any)?']		= 'epg/schedule$1';

// back-end
$route['epg/admin/channels(/:any)?']		= 'admin_channels$1';
$route['epg/admin/shows(/:any)?']			= 'admin_shows$1';
$route['epg/admin/upload(/:any)?']			= 'admin_upload$1';