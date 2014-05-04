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
session_start();
 
// init app with app id and secret
FacebookSession::setDefaultApplication( '235958703262480','f608ec2687f60c051396c4d0fabaae06' );
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://localhost/fbtest/getpageaccesstoken.php' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}


 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  
  // print data
  echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';

  $graph_query = $graphObject->getProperty('id');
  $graph_query = '/' . $graph_query . '/accounts';

  //graph request for list of pages
  $pagetokenrequest = new FacebookRequest( $session, 'GET', $graph_query);
  $pagetokenresponse = $pagetokenrequest->execute();

  //get response
  $pagetokenObject = $pagetokenresponse->getGraphObject();

  echo '<pre>';
    print_r($pagetokenObject);
  echo '</pre>';

} else {
  // show login url
  $params = array(
    'scope' => 'manage_pages',
  );

  echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';
}
