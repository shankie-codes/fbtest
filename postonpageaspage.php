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
$helper = new FacebookRedirectLoginHelper( 'http://localhost/fbtest/postonpageaspage.php' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}

/**
*A bit of digging around suggest that user access tokens expire after 60 days, but page access tokens are indefinite unless the user revokes access
**/

 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  
  // print user data
  // echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';

  $graph_query = $graphObject->getProperty('id');
  $graph_query = '/' . $graph_query . '/accounts';

  //graph request for list of pages
  $pagetokenrequest = new FacebookRequest( $session, 'GET', $graph_query);
  $pagetokenresponse = $pagetokenrequest->execute();

  //get response
  $pagetokenObject = $pagetokenresponse->getGraphObject();

  $pagetokenid = $pagetokenObject->getPropertyAsArray('data')[0]->getProperty('access_token');
  $pageid = $pagetokenObject->getPropertyAsArray('data')[0]->getProperty('id');

  echo '<pre>';
    print_r($pagetokenid);
  echo '</pre>';

  echo '<pre>';
    print_r($pageid);
  echo '</pre>';

  // graph api request to post a message
  $url = '/' . $pageid . '/feed';
  $params = array(
    'message' => 'hi there',
    // 'access_token' => $pagetokenid
    );
  $request = new FacebookRequest( $session, 'POST', $url, $params);
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();

  echo '<pre>';
    print_r($graphObject);
  echo '</pre>';

} else {
  // show login url
  $params = array(
    'scope' => 'manage_pages',
  );

  echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';
}
