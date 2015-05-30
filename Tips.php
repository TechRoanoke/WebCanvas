<?php

session_start();

	echo <<<_END


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

</head>
<body>
_END;

//Bring in the nav bar
include 'NavBar.php';
	echo <<<_END
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class="hidden-xs">
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class="visible-xs" ;="" width="100%">
<div class="container main-window">
	<h3>Canvassing Tips:<small><em>&nbsp;Update this list from the PCO Field Guide</em></small></h3>
	<ul>
		<li>You might be the only impression a voter ever gets of your party or your candidate.  So dress casually but nice, smile genuinely, take their concerns and complaints seriously.</li>
		<li>Never ring or knock twice.  So be sure your first ring or knock can be heard.  Then leave if no one answers.</li>
		<li>Do not knock where there is a "No Solicitors" sign, even though you have a legal right to do so.</li>
		<li>Never debate, nor should you spend 10minutes agreeing with someone, move on.</li>
		<li>Mark where you parked.  Streets all start to look the same.</li>
		<li>Carry water with and have a bathroom plan so that you never have to ask a voter if you may enter their house.</li>
		<li>Never enter a voter's home.</li>
		<li>Make note of the various indicators:  Bumper Stickers, American Flag on display? Religious messages or symbols?, hybrid or electric car?</li>
	</ul>
	


</div>
<!-- Close Main Div -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src='js/TempDataSource.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/BasicFunctions.js"></script>
	<script src="js/TR_CanvassApp_Common.js"></script>
	<script>
		$(document).ready(function() {
			$('.nav>li').removeClass('active');
			$('a[href="Tips.php"]').parent().addClass('active');
		});
	</script>
</body>
</html>
_END;
?>