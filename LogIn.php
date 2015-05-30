<?php
//require_once 'BasicFunctions.php';
session_start();

if (isset($_GET['code'])){
	$Code = $_GET['code'];
	$service_url = '<loginendpoint>/login/code?code='.$Code;
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$aryTokenData = json_decode($curl_response,true);
	if (isset($aryTokenData->response->status) && $aryTokenData->response->status == 'ERROR') {
		die('error occured: ' . $aryTokenData->response->errormessage);
	}
	$intOneHour = 60*60;
	$intOneDay = $intOneHour*24;
	$intOneMonth = $intOneHour*24*30;
	$intLongTime = $intOneMonth*5;

	setcookie('Token',$aryTokenData['AuthToken'],time() + $intOneDay,'/');//Save token for the day
	setcookie('Server',$aryTokenData['Server'],time() + $intOneDay,'/');
	echo '<script type="text/javascript">window.location = "Test.php"</script>';

}
else{

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
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class='hidden-xs'>
<img src="http://www.techroanoke.com/wp-content/uploads/2015/03/logo_text_Transparent.gif" class='visible-xs' width="100%";>
<div class="container main-window index-window">
	<h1 class='hidden-xs'>Canvassing App</h1>
	
<form action="LogIn.php" method="GET">
	<div class="form-group has-feedback has-success">
		<label for="Code">Enter List Code:</label>
		<input type="text" class="form-control" id="code" name='code' placeholder="33K5EEPkJ7" style='width:130px;' value='charlie12345'>
	</div>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
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

}
?>