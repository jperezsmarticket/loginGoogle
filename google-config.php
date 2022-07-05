<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID | Copiar "ID DE CLIENTE"
// $google_client->setClientId('378782294424-mdntbirbjp9ekp1pcoik7bmh4r6nmh9v.apps.googleusercontent.com');

$google_client->setClientId('378782294424-79g55hcval1d86ilfadpprbni6q5l031.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
// $google_client->setClientSecret('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');

$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
$google_client->setRedirectUri('http://localhost/LoginGoogle/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>