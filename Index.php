<?php

session_start();

	echo <<<_END
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TechRoanoke Canvass Web App</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link href="css/TR_CanvassApp_Common.css" rel="stylesheet">
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.btn{
			margin-top:10px;
			margin-bottom: 10px;
		}
	</style>
  </head>
  <body>
_END;

//Bring in the nav bar
include 'NavBar.php';
	echo <<<_END
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class='hidden-xs'>
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class='visible-xs' width="100%";>
<div class="container main-window index-window">
	<h1 class='hidden-xs'>Canvassing App</h1>
	<h4><p class='small hidden-xs'>
		 This web application is a data window that allows canvassers and candidates to interface with a common TechRoanoke database. The data you input is never erased or overwritten.
		</p>
	</h4>
	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<a href="PaperWalk.php" class="btn btn-success btn-block" type="button">P-Walk</a>
		</div>
		<div class="col-lg-6 text-center hidden-xs">
			<p>
				Print out a paper walk list, or save the results from a completed canvass.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<a href="EWalk.php" class="btn btn-success btn-block" type="button">E-Walk</a>
		</div>
		<div class="col-lg-6 text-center hidden-xs">
			<p>
				Use your smart phone or tablet to record your canvass results as you walk.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<a href="InstantEntry.php" class="btn btn-success btn-block" type="button">Instant Entry</a>
		</div>
		<div class="col-lg-6 text-center hidden-xs">
			<p>
				Find and enter data on a single person or address.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<a href="Tips.php" class="btn btn-default btn-block" type="button">Tips</a>
		</div>
		<div class="col-lg-6 text-center hidden-xs">
			<p>
				Tips on how to use this application AND canvass successfully.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<a href="About.php" class="btn btn-default btn-block" type="button">About</a>
		</div>
		<div class="col-lg-6 text-center hidden-xs">
			<p>
				Learn where the data comes from, where it goes and how it is used.
			</p>
		</div>
	</div>
</div>
<!-- Close Main Div -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src='js/TempDataSource.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.nav>li').removeClass('active');
			$('a[href="Index.php"]').parent().addClass('active');
		});
	</script>
  </body>
</html>

_END;
?>
