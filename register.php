<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

//connection to the database
require 'db.php';

//session session_start
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # code...
  $first_name = $mysqli->escape_string(test_input($_POST['first_name']));
    $last_name = $mysqli->escape_string(test_input($_POST['last_name']));
      $email = $mysqli->escape_string(test_input($_POST['email']));
        $password = $mysqli->escape_string(test_input($_POST['password']));

          $hash = $mysqli->escape_string(md5(rand(0,1000)));

          $error = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'password' => ''
          ];

          if($first_name == ''){

            $error['first_name'] = 'First name is required.';
          }

          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {

            $error['first_name'] = "Only letters and white space allowed.";
          }

          if($last_name == ''){

            $error['last_name'] = 'Last name is required.';
          }

          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {

            $error['last_name'] = "Only letters and white space allowed.";
          }

          if ($email == '') {

            $error['email'] = 'Email is required.';
            # code...
          }

          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email']  = "Invalid email format.";
          }

          // Check if user with that email already exists
          $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'") or die($mysqli->error());

          if ($result->num_rows > 0) {

              $error['email'] = 'Email already exists,<a href="login.php" class="text-primary m-l-5"><b>Please Sign In.</b></a>';
          }

          if($password === ''){

            $error['password'] = 'Password is required.';
          }

          foreach ($error as $key => $value) {
            if (empty($value)) {
              unset($error[$key]);
              # code...
            }
          }
          if (empty($error)) {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);

            // active is 0 by DEFAULT (no need to include it here)
            $sql = "INSERT INTO users (first_name, last_name, email, password, hash) VALUES ('$first_name','$last_name','$email','$password_hashed', '$hash')";

                if ($mysqli->query($sql) === TRUE) {
                  echo "New record created Successfully";
                  header("Location: index.php");

                }
              }

}

 ?>
<!DOCTYPE html>
<html>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<title>Elisonz - Expanding Possibilities</title>

      <!-- Sweet Alert -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

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

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Sign Up to <strong class="text-custom">ELIsonz</strong> </h3>
				</div>

				<div class="panel-body">
					<form class="form-horizontal m-t-20" action="" method="POST">

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="first_name" placeholder="First Name"
                value="<?php echo isset($first_name) ? $first_name :'' ;?>">
                <p class="text-danger"><?php echo isset($error['first_name']) ? $error['first_name'] : '' ; ?></p>
							</div>
						</div>
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="last_name" placeholder="Last Name"
                value="<?php echo isset($last_name) ? $last_name :'' ;?>">
                <p class="text-danger"><?php echo isset($error['last_name']) ? $error['last_name'] : '' ; ?></p>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="email" name="email"  placeholder="Email"
                value="<?php echo isset($email) ? $email :'' ;?>">
                <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ; ?></p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" name="password"  placeholder="Password"
                 value="<?php echo isset($password) ? $password :'' ;?>">
                <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : '' ; ?></p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<div class="checkbox checkbox-primary">
									<input id="checkbox-signup" type="checkbox" checked="checked">
									<label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
								</div>
							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" name="submit_register" type="submit">
									Register
								</button>
							</div>
						</div>

					</form>

				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						Already have account?<a href="index.php" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
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

        <!-- Sweet-Alert  -->
       <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

	</body>

<!-- Mirrored from coderthemes.com/ubold_2.2/menu_2/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2017 17:18:52 GMT -->
</html>
