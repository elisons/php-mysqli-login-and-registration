
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <title>Elisonz - Expanding Possibilities</title>
    <!-- Sweet Alert -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Sweet-Alert  -->
   <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
  </head>
  <body>
    <?php
    /* Log out process, unsets and destroys session variables */
    session_start();
    session_unset();
    session_destroy();
    echo $welcome = "<script type='text/javascript'>
    swal({
      text: 'You have logged out successfully',
      type: 'success',
      timer: 3000,
      showConfirmButton: false
    });

    setTimeout(function(){
      window.location.href = 'index.php';
    }, 2000);
    </script>";
    ?>
  </body>
</html>
