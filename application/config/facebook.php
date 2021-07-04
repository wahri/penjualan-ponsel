<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string   Your facebook app ID.
|  facebook_app_secret           string   Your facebook app secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string   URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array    The permissions you need.
|  facebook_graph_version        string   Set Facebook Graph version to be used. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to have the library to check for valid access token on every page load.
*/



$config['facebook_app_id']              = '283419675395199';
$config['facebook_app_secret']          = '3102be4c11902d96bf907d69c00c6c37';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'admin/social_media/fb_login';
$config['facebook_logout_redirect_url'] = 'example/logout';
$config['facebook_permissions']         = array('email','user_location','user_birthday','publish_actions','publish_pages','manage_pages','public_profile','user_managed_groups');
$config['facebook_graph_version']       = 'v2.10';
$config['facebook_auth_on_load']        = TRUE;
