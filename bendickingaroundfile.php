<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

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


  try {

    //include 'postphotototimeline.php';

    $user_id =  $graphObject->getProperty('id');

    //$data = (new FacebookRequest( $session, 'Get', 'me/accounts'))->execute;


    //echo '<pre>'. print_r($data). '</pre>';

    $permissions = (new FacebookRequest( $session, 'GET' , '/me/permissions' ))->execute();
    //$permissionObject = $permissions->getGraphObject

    echo '<pre>'. print_r($permissions->getGraphObject(), 1). '</pre>';

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   


} else {

  $params = array(
    'scope' => 'read_stream, user_friends, friends_likes, publish_actions',
  );

  // show login url
  echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';



}
?>