<?php
require_once __DIR__ . '/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '1706396766311154',
  'app_secret' => '18189e9f8eb91a68a0880d0df6d428f9',
  'default_graph_version' => 'v2.5',
]);
$helper = $fb->getCanvasHelper();
$permissions = ['email']; // optionnal
try {
  if (isset($_SESSION['facebook_access_token'])) {
  $accessToken = $_SESSION['facebook_access_token'];
  } else {
      $accessToken = $helper->getAccessToken();
  }
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
 }
if (isset($accessToken)) {
  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  } else {
    $_SESSION['facebook_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }
  // validating the access token
  try {
    $request = $fb->get('/me');
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    if ($e->getCode() == 190) {
      unset($_SESSION['facebook_access_token']);
      $helper = $fb->getRedirectLoginHelper();
      $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/moab-test/', $permissions);
      echo "<script>window.top.location.href='".$loginUrl."'</script>";
      exit;
    }
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=id,name,first_name,last_name,email');
    $profile = $profile_request->getGraphNode()->asArray();
    $_SESSION['facebook_user_id'] = $profile['id'];
    $_SESSION['first_name'] = $profile['first_name'];
    $_SESSION['last_name'] = $profile['last_name'];
    $_SESSION['email'] = $profile['email'];
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    unset($_SESSION['facebook_access_token']);
    echo "<script>window.top.location.href='https://apps.facebook.com/moab-test/'</script>";
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  // priting basic info about user on the screen
    // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
  $helper = $fb->getRedirectLoginHelper();
  $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/moab-test/', $permissions);
  echo "<script>window.top.location.href='".$loginUrl."'</script>";
}
?>