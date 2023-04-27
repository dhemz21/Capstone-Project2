<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE INFORMATION -->
    <meta name="description" content="Events and Activities Attendance Management Monitoring and Information System">
    <meta name="authors" content="EVSU OCC Students">
    <!-- WEBSITE TITLE -->
    <title>AMM-Information System</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/evsu.png">

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    

    <!-- Booststrap only -->
    <link rel="stylesheet" href="dist/css/bootstrap.css">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <!-- FontawesomeIcon online -->
    <link rel="stylesheet" href="vendors/fontawesome-free/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="dist/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Jquery -->
    
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/jquery/jquery.slim.min.js"></script>
    <!-- <script src="https://kit.fontawesome.com/eebafef846.js" crossorigin="anonymous"></script> -->

<script>
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('js/service-worker.js', {
    scope: 'js/service-worker.js'
  }).then(function(registration) {
    console.log('Service worker registration successful with scope: ', registration.scope);
  }, function(err) {
    console.log('Service worker registration failed: ', err);
  });
}

</script>



 
</head>