<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1706396766311154',
  'app_secret' => '18189e9f8eb91a68a0880d0df6d428f9',
  'default_graph_version' => 'v2.5'
]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
   $fb->setDefaultAccessToken($accessToken);

  try {
  
    $requestProfile = $fb->get("/me?fields=name,email");
    $profile = $requestProfile->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
  }

  $_SESSION['name'] = $profile['name'];
  header('location: ../');
  exit;
} else {
    echo "Unauthorized access!!!";
    exit;
}
