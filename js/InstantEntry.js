"use strict"
var aryDATA = funcFakeData();
function funcFindName() {
	//Note: GH@$88s When arySearchText exceeds a length of 1, then the function needs to be "AND" with prior results.
	//e.g. now, search text of "Smith, John" will return Adams, John; Smith, John; Smith, Tammy instead of just "Smith, John"
	//Only start searching once you have at least 4 characters
	var htmlResults = '';
	if($('#inpSearch').val().length > 3){
		var arySearchText = $('#inpSearch').val().toLowerCase().split(' ');
		var aryResults = [];
		
		//Find matches in the array
		for(var x=0;x<aryDATA.length;x++){
			for(var y=0;y<arySearchText.length;y++){
				//Search name, street and street number field
				if(aryDATA[x]['Street'].toLowerCase().indexOf(arySearchText[y]) != -1
					|| aryDATA[x]['StreetNumber'].indexOf(arySearchText[y]) != -1
					|| aryDATA[x]['LastName'].toLowerCase().indexOf(arySearchText[y]) != -1
					|| aryDATA[x]['FirstName'].toLowerCase().indexOf(arySearchText[y]) != -1){
						aryResults.push(x);
					}
			}
			//Return a maximum of 6 results
			if(aryResults.length > 5){
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
	var html = "<div style='border-style: solid;border-width: 1px; border-color: #545454;'><table class='table table-striped table-hover table-condensed'><tbody>";
	for(var x=0;x<ary.length;x++){
		html += "<tr onclick='funcNameSelect($(this))'><td class='hidden'>" + aryDATA[ary[x]]['VoterID'] + "</td>";
		html += "<td>" + aryDATA[ary[x]]['LastName'] + ",&nbsp;" + aryDATA[ary[x]]['FirstName'] + "</td>";
		html += "<td>" + aryDATA[ary[x]]['StreetNumber'] + "&nbsp" + aryDATA[ary[x]]['Street'] + "</td></tr>";		
	}
	if(ary.length > 5){
		html += "<tr><td><small><em>Narrow your search . . .</em></small></td><td></td></tr>";
	}
	html += "</tbody></table>";
	return html;
}
function funcNameSelect(obj){
	alert("Under Construction: User will be taken to a data input page for VoterID: " + $(obj).find('td:first-child').text());
	
}