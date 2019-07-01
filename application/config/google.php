<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google_client_id']= '33453507366-qf1alu7b0ekbeac8qtom3iedh48b5oop.apps.googleusercontent.com';
$config['google_client_secret']    = 'slvZaDV8ZJ_5wbUUiMlnyQXH';
$config['google_redirect_url']    = 'http://kb.tempemenjes.com/pribadi/sena/user_authentication/oauth2callback';
$config['google']['application_name'] = 'Login to CodexWorld.com';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();