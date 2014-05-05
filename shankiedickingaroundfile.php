<?php


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

/****************************************************/

  $pageid = '276813939159864';
  $pagetokenid = 'CAADWmmqwixABADL9KJLpW5MtAoU2XIwnrvZCQw3MbaAyvZA6hi49H1bCL7GCW5AkIFvh1V36jZCqC8XgmQZBGZBI9YwTh5rgfSloPqCn7AaYgqHegNGrI9B8VmkEijOLLZAt5WQqh66zuP1yiOmvG1LXUHLn9u3lSkhKHiWpO8eyl40CqsjZBGZA8PWKD5hgVMUZD';
  $url = '/' . $pageid . '/feed';
  $params = array(
    'message' => 'a revolution',
    );

  $session = new FacebookSession($pagetokenid);
  $request = new FacebookRequest( $session, 'POST', $url, $params);
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();

  echo '<pre>';
    print_r($graphObject);
  echo '</pre>';