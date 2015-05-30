<?php
function sanitizeString($var)
{
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	//global $con; // Allow function access to global $db variable
	return real_escape_string($var);
}
function funcFillArray($strResult,$strType='MYSQLI_ASSOC')//MYSQLI_BOTH,MYSQLI_ASSOC,MYSQLI_NUM
{
	$aryReturn = array();
	switch ($strType) {
		case "MYSQLI_BOTH":
			while ($aryReturn[] = mysqli_fetch_array($strResult, MYSQLI_BOTH)) {
			}
			break;
		case "MYSQLI_ASSOC":
			while ($aryReturn[] = mysqli_fetch_array($strResult, MYSQLI_ASSOC)) {
			}
			break;
		case "MYSQLI_NUM":
			while ($aryReturn[] = mysqli_fetch_array($strResult, MYSQLI_NUM)) {
			}
			break;
	}
	array_pop($aryReturn);
	return $aryReturn;

}
function funcConvertMultiDimArray($aryMulti,$col){
	for($i=0;$i<count($aryMulti);++$i){
		$aryTemp[]=$aryMulti[$i][$col];
	}
	return $aryTemp;
}
function flatten_array($mArray) {
	$sArray = array();

	foreach ($mArray as $row) {
		if ( !(is_array($row)) ) {
			if($sArray[] = $row){
			}
		} else {
			$sArray = array_merge($sArray,flatten_array($row));
		}
	}
	return $sArray;
}
function funcSelectFromRecordSet($rvsRecordSet,$strSelection=null){
	$aryTemp = funcConvertMultiDimArray(funcFillArray($rvsRecordSet,'MYSQLI_BOTH'),0);
	return SelectFromArray($aryTemp,$aryTemp,$strSelection);
}
function SelectFromConcant($strOptions,$strTextOptions,$strSplitter,$strSelection = null)
{
	$aryOptions=explode($strSplitter,$strOptions);
	$aryText=explode($strSplitter,$strTextOptions);
	return SelectFromArray($aryOptions,$aryText,$strSelection);
}

function SelectFromArray($aryOptions,$aryText,$strSelection = null)
{
	$strHtmlSelect="";
	for($i=0;$i<count($aryOptions);++$i)
	{
		if(!$aryOptions[$i]){
			//Null
		}
		else{
			if($aryOptions[$i]==$strSelection)
			{
				$strHtmlSelect .= "<option value='".$aryOptions[$i]."' selected>".$aryText[$i];
			}
			else
			{
				$strHtmlSelect .= "<option value='".$aryOptions[$i]."'>".$aryText[$i];
			}
			$strHtmlSelect .= "</option>";
		}
	}
	return $strHtmlSelect;
}
function DropDownFromConcant($strConcat)
{
	$aryList=explode(";",$strConcat);
	return DropDownFromArray($aryList);

}
function DropDownFromArray($aryList)
{
	$strHtmlDropDown="<div class='dropdown'><span class='help-block' data-toggle='dropdown' onclick=$(this).dropdown()>";
	$strHtmlDropDown .=$aryList[0]."&nbsp<button type='button' class='btn btn-xs dropdown-toggle btn-default' data-toggle='dropdown'><span class='caret'></span></button></span>";
	$strHtmlDropDown .= "<ul class='dropdown-menu' role = 'menu'>";
	for($i=0;$i<count($aryList);$i++)
	{
		$strHtmlDropDown .= "<li role='presentation'><a role='menuitem' tabindex='-1' href='#'>".$aryList[$i]."</a></li>";
	}
	$strHtmlDropDown .= "</ul>";
	$strHtmlDropDown .="</div>";
	return $strHtmlDropDown;
}
function tableFromRecordSet($rvsRecordSet,$tblID)
{
	$aryData=funcFillArray($rvsRecordSet,'MYSQLI_ASSOC');
	$finfo = mysqli_fetch_fields($rvsRecordSet);
	$aryFields=array();
	foreach ($finfo as $val) {
		array_push($aryFields, $val->name);
	}
	return tableFromArray($aryData,$aryFields,$tblID);
}
function tableFromArray($aryData,$aryFields,$tblID)
{
	//Initialize the table and header row
	if($tblID=='')
	{
		$tblID='tblGenerated'.rand();
	}
	$strTable = "<div class='table-responsive'><table id='$tblID' class='table table-condensed table-striped table-hover'><thead><tr>";
	for($i=0;$i<count($aryFields);$i++)
	{
		$strTable .="<th>".addSpaceAndCapitolize($aryFields[$i],'false')."</th>";
	}
	$strTable .="</tr></thead><tbody>";

	//Add in the data fields
	for($x=0;$x<count($aryData);$x++)
	{
		$strTable .="<tr id='tblRow$x'>";
		for($y=0;$y<count($aryFields);$y++)
		{
			$strTable .="<td><div class='tablediv'>".$aryData[$x][$aryFields[$y]]."</div></td>";
		}
		$strTable .="</tr>";
	}
	$strTable .="</tbody></table></div>";
	return $strTable;
}
function addSpaceAndCapitolize($strIncoming,$blnCap)
{
	$strReturn='';
	$aryReturn = split(",",substr(preg_replace("/([A-Z])/",',\\1',$strIncoming),1));
	for($i=0;$i<count($aryReturn);$i++)
	{
		$strReturn = $strReturn.$aryReturn[$i]." ";
	}
	return $strReturn;
}


?>
