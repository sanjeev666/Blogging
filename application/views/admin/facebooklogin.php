<html>
  <header>
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
   
  </header>
    <style>
        #facebook-button
        {   
         background: white;
        color: black;
        border-radius: 5px;
        border: 1px solid #80808087;
        white-space: nowrap;
        padding:10px 20px;
        font-family: medium-content-sans-serif-font, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Arial, sans-serif;
        cursor: pointer;

        }

        span.icon1 {
      background: url('<?php echo base_url(); ?>assets/upload/facebook.ico') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    
    </style>
  <body>
    <a id="facebook-button" class="">
    <span class="icon1"  >  </span> Sign in with Facebook
    </a>

    <script>
      $('#facebook-button').on('click', function() {
        // Initialize with your OAuth.io app public key
        OAuth.initialize('AQsw2OcovUi64gWg9UxSxjlR91E');
        // Use popup for oauth
        OAuth.popup('facebook').then(facebook => {
          console.log('facebook:',facebook);
          // Prompts 'welcome' message with User's email on successful login
          // #me() is a convenient method to retrieve user data without requiring you
          // to know which OAuth provider url to call
          facebook.me().then(data => {
            console.log('me data:', data);
            // alert('Facebook says your email is:' + data.email + ".\nView browser 'Console Log' for more details");
          })
          // Retrieves user data from OAuth provider by using #get() and
          // OAuth provider url
          facebook.get('/v2.5/me?fields=name,first_name,last_name,email,gender,location,locale,work,languages,birthday,relationship_status,hometown,picture').then(data => {
            console.log('self data:', data);
          })
        });
      })
    </script>
  </body>
</html>