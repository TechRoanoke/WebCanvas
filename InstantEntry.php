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
	<h3>Instant Entry:</h3>
	<form>
		<div class='form-group has-success has-feedback'>
			<label for='inpSearch'>Name/Address:</label>
			<input type='text' class='form-control' id='inpSearch' onkeyup='funcFindName()'>
		</div>
	</form>
	</div>
<!-- Close Main Div -->
<div id='divResultsContainer' class='container' style='max-width: 600px; margin-top:10px;'>

</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src='js/TempDataSource.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/BasicFunctions.js"></script>
	<script src="js/InstantEntry.js"></script>
	<script>
		$(document).ready(function() {
			$('.nav>li').removeClass('active');
			$('a[href="InstantEntry.php"]').parent().addClass('active');
		});
		
	</script>
</body>
</html>
_END;
?>