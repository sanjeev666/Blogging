<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="458328091534-042eb8tdivaq1s27nj7so8mjr1r3ji2s.apps.googleusercontent.com">
    <title>Document</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src=""></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</head>
<body>
    fdsfdsf
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <script>
        function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        // console.log('Name: ' + profile.getName());
        // console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('users/checkEmail'); ?>",
                data: {email:profile.getEmail()},
                dataType: "json",
                success: function (response) {
                   console.log(response.err);

                   if(response.err == '200')
                   {
                    window.location.href = "http://localhost/onveraft/";
                   }
                   else
                   {
                    window.location.href = "http://localhost/onveraft/users/googles";
                   }
                   
                }
            });
        // console.log(typeof(profile));
        
}


    </script>
</body>
</html>