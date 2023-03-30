<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex">
	<link rel="icon" href="mg/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" type="<?php echo $path; ?>image/png" href="favicon-16x16.png"/>
	<!--<meta http-equiv="refresh" content="5">-->

	<link rel="stylesheet" href="<?php echo $path; ?>bootstrap/css/bootstrap.min.css" media="screen">
	<link rel="stylesheet" href="<?php echo $path; ?>bootstrap/css/bootstrap-theme.min.css" media="screen">

	

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $path; ?>css/style.css" type="text/css"  />
	<link rel="stylesheet" href="<?php echo $path; ?>css/style-min.css" type="text/css"  />

	<script src="<?php echo $path; ?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo $path; ?>js/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $path; ?>js/functionsJS.js"></script>

	<title>Tools</title>

</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	  <a class="navbar-brand" href="/">
	  	<img src="<?php echo $path; ?>img/ed-logo-137x120.png" width="80" height="70" alt="Executive Digital Logo">
	  </a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon">|||</span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarNav">
<?php  
	if ($user->is_loggedin() != "") {
?>
		<ul class="navbar-nav">

			<li class="nav-item">
				<a class="nav-link" href="<?php echo $path; ?>sites">Sites</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo $path; ?>indexcheck">Indexing Checker</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo $path; ?>portal">Portal</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo $path; ?>settings">
					<i class="fa fa-cog" aria-hidden="true"></i>
				</a>
			</li>

		</ul>

		
<?php } ?>

		</div>

		<div class="login-header">
			<a href="<?php echo $path; ?>logout.php"><button class="submit yellow-button" name="logout"> LOGOUT </button></a>
		</div>

	</nav>

	<div id="pop-up">
	</div>