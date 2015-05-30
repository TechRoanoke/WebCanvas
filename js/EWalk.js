"use strict"
var intCURRENTRECORD = 0;
var intPREVRECORD = -1;
var intNEXTRECORD = 1;
var aryCURRENTSTREET = [];
var arySTREETLIST = [];
var aryVOTERCOUNT = [];
//Group the streets together

funcCompileStreets();
function funcCompileStreets(){
	aryDATA.sort(function(a,b){
		var a1=a.Street.toLowerCase(),b1=b.Street.toLowerCase();
		if(a1== b1) return 0;
		return a1> b1? 1: -1;
	});
	var strCapturedStreets = ";";
	var intVoterCount = 1;
	for(var x=0;x<aryDATA.length;x++){
		if(strCapturedStreets.indexOf(aryDATA[x]['Street']) == -1){
			if(x>0){
				aryVOTERCOUNT.push(intVoterCount);				
			}
			arySTREETLIST.push(aryDATA[x]['Street']);
			strCapturedStreets += aryDATA[x]['Street'] + ";";
			intVoterCount = 1;
		}
		else{
			intVoterCount ++;
		}
	}
}


function funcFindStreet() {
	//Only start searching once you have at least 3 characters
	var htmlResults = '';
	if($('#inpSearch').val().length > 2){
		var strSearchText = $('#inpSearch').val().toLowerCase();
		var strMatches = ";";
		var aryResults = [];

		//Find matches in the array
		for(var x=0;x<arySTREETLIST.length;x++){
			if(arySTREETLIST[x].toLowerCase().indexOf(strSearchText) != -1 && strMatches.indexOf(arySTREETLIST[x].toLowerCase()) == -1){
					aryResults.push(x);
					strMatches += aryDATA[x]['Street'].toLowerCase() + ";";
			}
			//Return a maximum of 5 results
			if(aryResults.length > 4){
				break;
			}
		}
		if(aryResults.length > 0)
		{
			htmlResults = funcTableOfSearchResults(aryResults);
		}
	}
	$('#divResultsContainer').html(htmlResults);
}
function funcTableOfSearchResults(ary){
	var html = "<table class='table table-striped table-hover table-condensed'>";
	html += "<thead><tr><th>Street</th><th>Voters</th></tr></thead><tbody>"
	for(var x=0;x<ary.length;x++){
		html += "<tr onclick='funcNameSelect($(this))'><td>" + arySTREETLIST[ary[x]] + "</td>";
		html += "<td><span class='badge'>" + aryVOTERCOUNT[ary[x]] + "</span></td></tr>";
		if(x > 4){
			html += "<tr><td><small><em>Narrow your search . . .</em></small></td><td></td></tr>";
			break;
		}
	}
	html += "</tbody></table>";
	return html;
}
function funcNameSelect(obj){
	$('#inpSearch').val($(obj).find('td:first-child').text());
	$('#divResultsContainer').html('');
	
}
function funcChooseOddEven(){
	if($('input[name=rdbOddEven]:checked', '#frmOddEven').val() == 'OddEven'){
		$('#frmOddEvenSequence').removeClass('hidden');
		$('.TR-Separator').removeClass('hidden');
	}
	else{
		$('#frmOddEvenSequence').addClass('hidden');
		$('#div2ndSeperator').addClass('hidden');		
	}
}
function funcStartWalk(){
	if($('#btnStart').text() == 'Start'){
		$('.div-street-name').text($('#inpSearch').val());
		var intStart = -1;
		$('.main-window').addClass('hidden');
		$('.input-window').removeClass('hidden');
		$('#divControls').removeClass('hidden');
		$('#btnStart').text('Back');
		$('#imgMainLogo').css({'width' : '25%'});
		funcSortMasterArray();
		
		//Create an array for just the current street
		for(var x=0;x<aryDATA.length;x++){

			if(aryDATA[x]['Street'] == $('#inpSearch').val() && intStart == -1){
				intStart = x;
			}
			else{
				if(aryDATA[x]['Street'] != $('#inpSearch').val() && intStart > -1){
					break;
				}
			}
		}
		aryCURRENTSTREET = aryDATA.slice(intStart,x);
		intCURRENTRECORD = 0;
		funcAddressContents();
	}
	else{
		$('.main-window').removeClass('hidden');
		$('.input-window').addClass('hidden');
		$('#divControls').addClass('hidden');
		$('#btnStart').text('Start');
		$('#imgMainLogo').css({'width' : '100%'});		
	}
}
function funcMove(i){
	var x = funcGetNext(i);
	if (x > -1){
		intCURRENTRECORD = x;
	}
	funcAddressContents();
}
function funcAddressContents(){
	intPREVRECORD = funcGetNext(-1);
	intNEXTRECORD = funcGetNext(1);
	
	$('#divStreetNos>.text-left').text(funcIsEnd(intPREVRECORD));			
	$('#divStreetNos>.text-center').html("<strong>" + aryCURRENTSTREET[intCURRENTRECORD]['StreetNumber'] + "</strong>");
	$('#divStreetNos>.text-right').text(funcIsEnd(intNEXTRECORD));
	
	//Add voter names
	var x = intCURRENTRECORD;
	var html = "<table class='table'><tbody><tr onclick='funcNoAnswer()'><td colspan='4' class='text-center'><h4>Click Here If No Contact</h4></td></tr>";
	while (aryCURRENTSTREET[intCURRENTRECORD]['StreetNumber'] == aryCURRENTSTREET[x]['StreetNumber']){
		alert(aryCURRENTSTREET[x]['FirstName']);
		html += "<tr onclick='funcPersonPicked($(this))'><td><div class='hidden'>" + aryCURRENTSTREET[x]['VoterID'] + "</div></td><td style='vertical-align:middle'><h4>" + aryCURRENTSTREET[x]['LastName'] + ", " + aryCURRENTSTREET[x]['FirstName'] + "</h4></td>";
		html += "<td style='vertical-align:middle'>" + aryCURRENTSTREET[x]['Gender'] + "</td><td style='vertical-align:middle'>45</td></tr>";
		x ++;
	}
	html += "</tbody></table>";
	$('.div-voter-holder').html(html);
	$('.div-voter-holder>table>tbody>tr:nth-of-type(odd)').addClass('altColorGreen');
}
function funcGetNext(intDirection){
	var x = intCURRENTRECORD;
	while (aryCURRENTSTREET[x]['StreetNumber'] == aryCURRENTSTREET[intCURRENTRECORD]['StreetNumber']) {
		x += intDirection;
		if(x < 0 || x > aryCURRENTSTREET.length-1){
			return -1;
		}
	}
	return x;	
}
function funcIsEnd(i){
	if(i<0){
		return "-END-";
	}
	else{
		return aryCURRENTSTREET[i]['StreetNumber'];
	}
}
function funcPersonPicked(obj){
	alert($(obj).find('.hidden').text());
}
function funcNoAnswer(){
	funcNotYet();
}
