<?php

    use Facebook\FacebookRequest;

    // Upload to a user's profile. The photo will be in the
    // first album in the profile. You can also upload to
    // a specific album by using /ALBUM_ID as the path  


    $response = (new FacebookRequest(
      $session, 'POST', page_id . '/feed', array(
        'message' => 'BAM!'
      )
    ));

    echo '<pre>'.print_r($response,1).'</pre>';

    $response->execute()->getGraphObject();

    // If you're not using PHP 5.5 or later, change the file reference to:
    // 'source' => @'/path/to/file.name'

    echo "Posted with id: " . $response->getProperty('id');
?>