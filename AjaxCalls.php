<?php
//require_once 'BasicFunctions.php';

$strAjaxName=($_POST['AjaxName']);

switch ($strAjaxName) {
    case "PullFullTable":
		$service_url = $_COOKIE['Server']."/sheets/0";
		$aryHeaders = array();
		$aryHeaders[] = 'Authorization:  bearer '.$_COOKIE['Token'];
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPGET, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $aryHeaders);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occurred during curl exec. Additional info: ' . var_export($info));
		}
		curl_close($curl);

		$data = explode("\n", $curl_response);
		// get the headers first
		$headers = array_map('trim', explode(',', array_shift($data)));
		$new_data = array();
		// get the values and use array combine to use the headers as keys for associative array
		foreach($data as $values) {
			$pieces = explode(',', $values);
			if(count($pieces) == count($headers)){
				$new_data[] = array_combine($headers, $pieces);
			}
		}
		echo json_encode($new_data);
		break;
	
	
    case "UpdateTable":
		$strValue=($_POST['Value']);
		$service_url = $_COOKIE['Server']."/sheets/0";
		$aryHeaders = array();
		$aryHeaders[] = 'Authorization:  bearer '.$_COOKIE['Token'];
		$aryHeaders[] = 'Content-Type: text/csv';
		//$data = array("RecId" => "WA009115228","Comments"=>$strValue);
		$data = "REcId,Comments/rWA009115228,ScrewIt";
		echo $service_url;
	
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $aryHeaders);
		curl_setopt($curl, CURLOPT_TRANSFERTEXT,true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occurred during curl exec. Additional info: ' . var_export($info));
		}
		curl_close($curl);

        break;
    default:
       echo "Switch Block Escape at:  fjq234875f" . $strAjaxName.":";
        break;
}



?>