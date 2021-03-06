<?php include('init.php'); ?>
<?php
if (auth('?', array('session_id' => session_id()))) {
	// user is already logged in
	header('Location: dashboard.php');
}

if ($_POST) {
	clean($_POST);
	i('+', 'login', $_POST);
	if (!valid('email', $_POST['email'])) {
		n('+', 'login', 'error', 'Invalid email address.');
	}
	if (!$userid = auth('?', array('email' => $_POST['email'], 'password' => md5($_POST['password'])))) {
		if (!n('?', 'login', 'error')) {
			n('+', 'login', 'error', 'Incorrect email/password combination.');
		}
	}
	
	if (!n('?', 'login', 'error')) {
		auth('^', array('session_id' => session_id(), 'last_login' => date('Y-m-d H:i:s')), $userid);
		// set cookie
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

	<title>Login - <?= $settings['name']; ?></title>

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
			<?php /*
			<form class="navbar-form navbar-right" method="post" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Tags">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>*/ ?>
			<ul class="nav navbar-nav navbar-right">
				<li class="active">
					<a href="login.php">Login</a>
				</li>
				<li>
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
			
<?php foreach (n('|', 'login', 'error') as $k => $message) { ?>
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
						<h2 class="panel-title">Login</h2>
					</div>
					<div class="panel-body">
						<form action="" method="post">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
								<input name="email" type="text" class="form-control" placeholder="Email" value="<?= i('|', 'login', 'email'); ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input name="password" type="password" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="checkbox">
							<label>
								<input name="remember" type="checkbox" checked="checked"> Remember me
							</label>
						</div>
						<input type="submit" class="btn btn-primary col-xs-12" value="Submit" />
						</form>
					</div>
					<div class="panel-footer">
						<div class="panel-title">
							<div>
								<a href="forgot.php" class="small">Forgot your password?</a>
								
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
<?php n('-', 'login'); i('-', 'login'); ?>