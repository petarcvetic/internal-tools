<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" type="image/png" href="favicon-16x16.png"/>
	<!--<meta http-equiv="refresh" content="5">-->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" media="screen">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css"  />
	<script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

	<title>Indexing/Noindexing</title>

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="<?php echo $path;?>index.php"><img src="img/ed-logo-137x120.png" width="80" height="70" alt="Executive Digital Logo"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		  <li class="nav-item <?php echo $active1; ?>">
			<a class="nav-link" href="index.php">Test Sites</a>
		  </li>
		  <li class="nav-item <?php echo $active2; ?>">
			<a class="nav-link" href="single-test.php">Single Test</a>
		  </li>
		  <li class="nav-item <?php echo $active3; ?>">
			<a class="nav-link" href="editing.php">Editing URL-s</a>
		  </li>
		</ul>
	  </div>
	</nav>

	<div id="pop-up">
	</div>