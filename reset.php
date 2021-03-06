<?php include('init.php'); ?>
<?php
if (auth('?', array('session_id' => session_id()))) {
	// user is already logged in
	header('Location: dashboard.php');
}

if (!$_GET || !$_GET['token']) {
	n('+', 'reset', 'error', 'Password reset token is invalid. Please use the <a href="forgot.php">forgot password</a> feature to resend a new password reset link.');
}
else {
	if (!$userid = auth('?', array('token' => $_GET['token']))) {
			n('+', 'reset', 'error', 'Password reset token is invalid. Please use the <a href="forgot.php">forgot password</a> feature to resend a new password reset link.');
	}
}

if ($_POST) {
	clean($_POST);
	i('+', 'reset', $_POST);
	if (!valid('text', $_POST['password'], 5)) {
		if (!n('?', 'reset', 'error')) {
			n('+', 'reset', 'error', 'Your password must be at least 5 characters in length.');
		}
	}
	if ($_POST['password'] !== $_POST['confirmpassword']) {
		if (!n('?', 'reset', 'error')) {
			n('+', 'reset', 'error', 'Passwords do not match.');
		}
	}
	if (!n('?', 'reset', 'error')) {
		$userid = auth('?', array('token' => $_GET['token']));
		auth('^', array('password' => md5($_POST['password']), 'session_id' => session_id(), 'token' => ''), $userid);
		header('Location: dashboard.php');
	}
}

?><!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Reset Password - <?= $settings['name']; ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="main-css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="main-css/modern-business.css" rel="stylesheet">

	<!-- More Custom CSS -->
	<link href="main-css/style.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="main-font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $settings['main_url']; ?>"><?= $settings['name']; ?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			
			<form class="navbar-form navbar-right" method="post" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Tags">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="login.php">Login</a>
				</li>
				<li class="active">
					<button id="registerbutton" type="button" class="btn btn-primary navbar-btn">Sign up</button>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>	

	<!-- Page Content -->
	<div class="container" id="content">
		<!-- Team Members -->
		<div class="row">
			
<?php foreach (n('|', 'reset', 'error') as $k => $message) { ?>
<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Error:</strong> <?= $message; ?>
	</div>
</div>
<?php } ?>

			<!--<div class="col-lg-12">
				<h2 class="page-header">Login</h2>
			</div>-->

			<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Reset your password</h2>
					</div>
					<div class="panel-body">
						<form action="" method="post">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input name="password" type="password" class="form-control" placeholder="New password">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input name="confirmpassword" type="password" class="form-control" placeholder="Confirm new password">
							</div>
						</div>
						
						<input type="submit" class="btn btn-primary col-xs-12" value="Submit" />
						</form>
					</div>
					<div class="panel-footer">
						<div class="panel-title">
							<div>
								<a href="login.php" class="small">Already have an account?</a>
								
								<div class="pull-right" style="text-align:right">
									<a href="register.php" class="small">Create an account</a>
								</div>
							</div>
						</div>
					</div>
				</div>
								
			</div>
		</div>
		<!-- /.row -->


		<hr>

		<!-- Footer -->
		<footer>
			<div class="row">
				<div class="col-lg-12">
					<p>Copyright &copy; <?= $settings['name']; ?> <?= date('Y'); ?></p>
				</div>
			</div>
		</footer>

	</div>
	<!-- /.container -->

	<!-- jQuery -->
	<script src="main-js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="main-js/bootstrap.min.js"></script>
	
	<!-- Custom JavaScript -->
	<script src="main-js/app.js"></script>
	

</body>

</html>
<?php n('-', 'reset'); i('-', 'reset'); ?>