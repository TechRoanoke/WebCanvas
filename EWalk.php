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
	
<style>
@media (min-width: 768px) {
	.input-window {
		max-width: 600px;
	}
}
@media (max-width: 767px) {
	.input-window{
		max-width: 100%;
		margin-left: 2px;
		margin-right; 2px;
	}
	.container-fluid{
		padding-right: 0px;
		padding-left: 0px;
	}
}
.input-window{
	background-color: #FFFFFF;
	border-style: solid;
	border-width: 2px;
	border-color: #45DB00;
	border-radius: 6px;
	margin-top: 30px;
	padding-bottom:5px;
}
#divControls{
	margin-top:10px;
	max-width: 600px;
}
</style>

</head>
<body>
_END;

//Bring in the nav bar
include 'NavBar.php';
	echo <<<_END
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class="hidden-xs">
<img id='imgMainLogo' src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class="visible-xs" width="100%">
<div class="container main-window">
	<h3>E-Walk List&nbsp;<small>(Parameters)</small></h3>
	<form>
		<div class='form-group has-success has-feedback'>
			<label for='inpSearch'>What Street are you on?</label>
			<input type='text' class='form-control' id='inpSearch' onkeyup='funcFindStreet()' placeholder='Street Name'>
		</div>
	</form>
	<div id="divResultsContainer" class="container-fluid" style="margin-top:10px;"></div>
	<form id='frmShowMe'>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbShowMe" id="rdbShowMe1" value="Hide" checked>
			Hide addresses after I visit them
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbShowMe" id="rdbShowMe2" value="All">
			Show me all doors
		  </label>
		</div>
	</form>
	<div class='TR-Separator'></div>
	<form id='frmDirection'>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbDirection" id="rdbDirection1" value="High2Low" checked>
			I am walking from high street numbers to low
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbDirection" id="rdbDirection2" value="Low2High">
			I am walking from low street numbers to high
		  </label>
		</div>
	</form>
	<div class='TR-Separator'></div>
	<form id='frmOddEven' onchange='funcChooseOddEven()'>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbOddEven" id="rdbOddEven1" value="Both" checked>
			I will hit houses on both sides of the street as I walk
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbOddEven" id="rdbOddEven2" value="OddEven">
			I want to walk down one side of the street, then come back down the other (sort by odd/even street numbers)
		  </label>
		</div>
	</form>
	<div id='div2ndSeperator' class='TR-Separator hidden'></div>
	<form id='frmOddEvenSequence' class='hidden'>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbOddEvenSequence" id="rdbOddEvenSequence1" value="Odd" checked>
			I will hit odd numbered houses first
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input type="radio" name="rdbOddEvenSequence" id="rdbOddEvenSequence2" value="Even">
			I will hit even numbered houses first
		  </label>
		</div>
	</form>
</div>
<!-- Close Main Div -->
<div class='container center-block' style='width: 340px; margin-bottom: 10px; margin-top: 10px;'>
	<button id='btnStart' type='button' class='btn btn-success center-block' style='width: 120px;' onclick='funcStartWalk()'>Start</button>
</div>
<div class="container input-window hidden">
	<div class="container-fluid">
		<div id='divStreetNos' class="row">
			<div class="col-xs-3 text-left h4">
				PREV
			</div>
			<div class="col-xs-6 text-center h3">
				<strong>HERE</strong>
			</div>
			<div class="col-xs-3 text-right h4">
				NEXT
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center h4 div-street-name">
				NE 118th Street
			</div>
		</div>
		<div class='div-voter-holder'></div>
	</div>
</div>
<div class='container-fluid hidden' id='divControls'>
	<div class='row'>
		<div class='col-xs-5 col-xs-offset-1'>
			<button class="btn btn-default btn-lg btn-block" type="button" onclick='funcMove(-1)'>Prev</button>
		</div>
		<div class='col-xs-5'>
			<button class="btn btn-default btn-lg btn-block" type="button" onclick='funcMove(1)'>Next</button>
		</div>
	</div>
</div>
<!-- Close data entry window -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src='js/TempDataSource.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/BasicFunctions.js"></script>
	<script src="js/TR_CanvassApp_Common.js"></script>
	<script src='js/EWalk.js'></script>
	<script>
		$(document).ready(function() {
			$('.nav>li').removeClass('active');
			$('a[href="EWalk.php"]').parent().addClass('active');
		});
	</script>
</body>
</html>
_END;
?>