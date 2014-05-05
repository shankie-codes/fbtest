<?php


/**
 * Load Facebook PHP SDK
 */
require_once('src/Facebook/FacebookSession.php' );
require_once('src/Facebook/FacebookRedirectLoginHelper.php' );
require_once('src/Facebook/FacebookRequest.php' );
require_once('src/Facebook/FacebookResponse.php' );
require_once('src/Facebook/FacebookSDKException.php' );
require_once('src/Facebook/FacebookRequestException.php' );
require_once('src/Facebook/FacebookAuthorizationException.php' );
require_once('src/Facebook/GraphObject.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
 
// start session
// session_start();

 
// init app with app id and secret
FacebookSession::setDefaultApplication( '235958703262480','f608ec2687f60c051396c4d0fabaae06' );
 
// login helper with redirect_uri

$helper = new FacebookRedirectLoginHelper( 'http://localhost/fbtest/index.php' );

// include 'bendickingaroundfile.php';
include 'shankiedickingaroundfile.php';

?>
