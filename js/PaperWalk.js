"use strict"

//Note: **AddColumn** This code needs to be revised in order to handle a variable amount of columns
var aryCOlWIDTHS = ["BLANK","medium","medium","narrow","narrow","medium","narrow","medium","medium","wide"];

var intCURRENTCOL;
var intCURRENTROW;
var objCURRENTCELL;
var strDATE;
var strTIME;

function funcSortTable(){
	funcSortMasterArray();
	var htmlTable = funcTableFromArray(aryDATA, aryFIELDS, 'TR-Table table-responsive table-bordered', 'tblWalkList');
	$('#divWalkList').html(htmlTable);
	funcStripeTable();
	funcSizeColumns();
}
function funcSizeColumns(){
	//Note: **AddColumn** This code needs to be revised in order to handle a variable amount of columns
	for(var i=0;i<aryCOlWIDTHS.length;i++){
		$('#tblWalkList td:nth-child(' + i + ')').addClass("td-width-" + aryCOlWIDTHS[i]);
	}
}
function funcAddColumn(){
	var html = "<form><div class='form-group has-feedback has-success'><label for='inpColumn'>Column Name:</label><input type='text' class='form-control' id='inpColumn' placeholder='ColumnName'></div>";
		html += "<button type='button' class='btn btn-default center-block' style='width: 120px;' onclick='funcRecordNewColumn()'>Submit</button></form>";
	$('#divHtmlSpace').html(html);
	$('#lblModalTitle').text("Add A New Column");
	$('#mdlUserInput').modal('toggle');
}
function funcRecordNewColumn(){
	//Note: **AddColumn** This code needs to be revised in order to handle a variable amount of columns
	//Add to aryDATA
	//Add to the table
	//Add to the csv file
	funcNotYet();
	$('#mdlUserInput').modal('toggle');
}
function funcEditTable(){
	if($('#btnRecord').text() == 'Record'){
		$('#btnRecord').text('Save');
		$('#btnRecord').siblings().addClass('hidden');
		$('#divNonPrintItems').addClass('hidden');
		var html = "<form><div class='form-group has-feedback has-success'><label for='inpDate'>Date:</label><input type='text' class='form-control' id='inpDate' placeholder='11/15/2015'></div>";
			html += "<div class='form-group has-feedback has-success'><label for='inp'>Start Time:</label><input type='text' class='form-control' id='inpTime' placeholder='5:00PM'></div>";
			html += "<button type='button' class='btn btn-default center-block' style='width: 120px;' onclick='funcRecordDateTime()'>Submit</button></form>"
		$('#divHtmlSpace').html(html);
		$('#lblModalTitle').text("When did you canvass?");
		$('#mdlUserInput').modal('toggle');
		
		//Note: **AddColumn** This code needs to be revised in order to handle a variable amount of columns
		var htmlSpan = "<span class='glyphicon glyphicon-pencil'></span>";
		$('#tlbWalkList th').addClass('locked');
		$('#tblWalkList tr').each(function (){
			$(this).find('td').slice(0,6).addClass('locked');
			$(this).find('td').slice(6,9).addClass('edit');
			if($(this).find('td:nth-child(8)').html() == ''){
				$(this).find('td:nth-child(8)').html(htmlSpan);
			}
			if($(this).find('td:nth-child(9)').html() == ''){
				$(this).find('td:nth-child(9)').html(htmlSpan);
			}
			$(this).find('td').slice(6,9).click(function(){
				funcEditCell($(this));
			});
			$(this).find('td:nth-child(6),th:nth-child(6)').hide();
		});
	}
	//The user hit "Save"
	else{
		$('#divNonPrintItems').removeClass('hidden');
		$('#btnRecord').text('Record');
		$('#btnRecord').siblings().removeClass('hidden');
		var html = "<div class='bg-success' style='padding: 20px;'><p>Your inputs have been saved, you may close this dialogue box.</p></div>";
		$('#divHtmlSpace').html(html);
		$('#lblModalTitle').text("Inputs Recorded");
		$('#mdlUserInput').modal('toggle');
		$('#tlbWalkList th').removeClass('locked');
		$('#tblWalkList tr').each(function (){
			$(this).find('td').slice(0,6).removeClass('locked');
			$(this).find('td').slice(6,9).removeClass('edit');
			if(String($(this).find('td:nth-child(8)').html()).indexOf('glyphicon') > -1){
				$(this).find('td:nth-child(8)').html('');
			}
			if(String($(this).find('td:nth-child(9)').html()).indexOf('glyphicon') > -1){
				$(this).find('td:nth-child(9)').html('');
			}
			$(this).find('td').slice(6,9).unbind();
			$(this).find('td:nth-child(6),th:nth-child(6)').show();
		});		
	}
}
function funcRecordDateTime(){
	strDATE = $('#inpDate').val();
	strTIME = $('#inpDate').val();
	$('#mdlUserInput').modal('toggle');
}
function funcPrintTable(){
	if($('#btnPrint').text() == 'Print'){
		$('#btnPrint').text('Return');
		$( "#btnPrint" ).siblings().addClass('hidden');
		$('.altColorGreen').addClass('altPrintGreen');
		$('#divNonPrintItems').addClass('hidden');
		$('#divPrintItems').removeClass('hidden');
		window.print();
	}
	else{
		$('#btnPrint').text('Print');
		$( "#btnPrint" ).siblings().removeClass('hidden');
		$('.altColorGreen').removeClass('altPrintGreen');
		$('#divNonPrintItems').removeClass('hidden');
		$('#divPrintItems').addClass('hidden');
	}
}
function funcEditCell(objCell){
	//Collect the edit data
	objCURRENTCELL = objCell;
	$(objCell).parent().addClass('altHighlightRow');
	intCURRENTCOL = $(objCell).index();
	intCURRENTROW = $('tr').index($(objCell).parent());
	var strCurrentValue = $(objCell).text();
	var strField = addSpaceAndCapitolize(aryFIELDS[intCURRENTCOL]);
	$('#lblModalTitle').text(strField);
	var aryOptions = [];
	var html;
	
	switch(strField) {
		case 'Party':
			aryOptions = ['Republican','Likely-Republican','Independant','Likely-Democrat','Democrat',"Unknown"];
			html = funcTableOfOptions(aryOptions,strCurrentValue);
			break;
		case 'Result':
			aryOptions = ['Not Home','No Solicitors','Wrong Address','Lit Drop','Too Busy','Talked Briefly'];
			html = funcTableOfOptions(aryOptions,strCurrentValue);
			break;
		case 'Notes':
			html = "<textarea id='txtNotes' class='form-control has-feedback has-success' rows='3' placeholder='Type notes here'>" + strCurrentValue + "</textarea>";
			html += "<button type='button' class='btn btn-default center-block' style='width:100px;' onclick = 'funcRecordAnswer($(this).text())'>Submit</button>"
			break;
		default:
			alert('Switch Block Escape:  GH%#3djs');
	}
	$('#divHtmlSpace').html(html);
	$('#mdlUserInput').modal('toggle');
	
}
function funcRecordAnswer(str){
	if(str=='Submit'){
		str = $('#txtNotes').val();
	}
	
	//Record to the database
	/*
	
	AJAX CALL TO CSV GOES HERE
	Save the time stamp, the voter id, the user ID email, the changed data
	
	
	*/

	// The "success" functions are listed here:
	//Record to the client array
	aryDATA[intCURRENTROW-1][aryFIELDS[intCURRENTCOL]] = str;
	
	//Record to client table
	$(objCURRENTCELL).text(str);
	$(objCURRENTCELL).parent().removeClass('altHighlightRow');
	$('#mdlUserInput').modal('toggle');
}
	
