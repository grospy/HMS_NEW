<?php

require_once $abs_us_root.$us_url_root.'users/src/Google/Google_Client.php';
require_once $abs_us_root.$us_url_root.'users/src/Google/contrib/Google_Oauth2Service.php';
$settingsQ = $db->query('SELECT * FROM settings');
$settings = $settingsQ->first();
if ($settings->glogin==0){
  die();
}
$gurl = $abs_us_root.$us_url_root;

//Getting the Google Info from the DB
$clientId = $settings->gid; //Google CLIENT ID
$clientSecret = $settings->gsecret; //Google CLIENT SECRET
$redirectUrl = $settings->gredirect;  //return url (url to script)
$homeUrl = $settings->ghome;  //return to home

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
