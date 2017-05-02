
<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Elisonz - Expanding Possibilities</title>
        <!-- Sweet Alert -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <!-- Sweet-Alert  -->
       <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-69506598-1', 'auto');
          ga('send', 'pageview');
        </script>


    </head>
    <body>
      <?php
      /* User login process, checks if user exists and password is correct */

      //connection to the database
      require 'db.php';

      //session session_start
      session_start();

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit_login'])) {
          $email = $mysqli->escape_string(test_input($_POST['email']));
            $password = $mysqli->escape_string(test_input($_POST['password']));

          $error = [
            'email' => '',
            'password'=>''
          ];

          //check if the email input is empty
          if ($email == '') {
            $error['email'] = "Email is required";
          }
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email']  = "Invalid email format.";
          }
          //check if the password input is empty
          if ($password == '') {
            $error['password'] = "Password is required";
          }


          foreach ($error as $key => $value) {
            if (empty($value)) {
              unset($error[$key]);
            }
          }
          if (empty($error)) {

            // Check if user with that email already exists
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'") or die($mysqli->error());

            // User exists
            $user = $result->fetch_assoc();

            //verify password if its correct
            if (password_verify($password, $user['password'])) {

              // This is how we'll know the user is logged in
              $_SESSION['logged_in'] = true;

              echo $welcome = "<script type='text/javascript'>
              swal({
                title: 'Welcome back',
                text: 'Logging Sucessful. Redirecting....',
                type: 'success',
                timer: 5000,
                showConfirmButton: false
              });

              setTimeout(function(){
                window.location.href = 'dashboard.php';
              }, 4000);
              </script>";

              // header('Location: dashboard.php');
            }else{
              header('Location: 404.php');
            }

          }
        }
      }
       ?>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Sign In to <strong class="text-custom">ELIsonz</strong> </h3>
            </div>


            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="" method="POST">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="email" placeholder="Enter Email"
                        value="<?php echo isset($email) ?   $email : ''; ?>">
                        <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '';?></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password"  placeholder="Password">
                        <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" name="submit_login" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="recover.php" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div>
            </form>

            </div>
            </div>
                <div class="row">
            	<div class="col-sm-12 text-center">
            		<p>Don't have an account? <a href="register.php" class="text-primary m-l-5"><b>Sign Up</b></a></p>

                    </div>
            </div>

        </div>




    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

	</body>

</html>
