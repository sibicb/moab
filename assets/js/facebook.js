// This is called with the results from from FB.getLoginStatus().
window.fbAsyncInit = function() {
FB.init({
  appId      : '1706396766311154',
  cookie     : true,  // enable cookies to allow the server to access 
                      // the session
  xfbml      : true,  // parse social plugins on this page
  version    : 'v2.5' // use graph api version 2.5
});
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    console.log('Logged in.');
    connectAPI();
    
  }
  else {
    FB.login();
  }
});

};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function connectAPI() {
  console.log('Welcome!  Fetching your information.... ');
  FB.api('/me?fields=first_name,last_name,email,gender', function(response) {
    console.log('Successful login for: ' + response.id);
    document.getElementById('facebook_user_id').value = response.id;
    document.getElementById('fname').value = response.first_name;
    document.getElementById('lname').value = response.last_name;
    document.getElementById('email').value = response.email;
    if (response.gender == "male") {
      document.getElementById('male').value = response.gender;
    }
    else {
      document.getElementById('female').value = response.gender;
    }
  });
}

