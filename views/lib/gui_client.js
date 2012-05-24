var showPins = new Array(1, 0, 35, 36, 9, 13, 12, 14, 7, 3, 26, 24, 17, 25, 20, 19, 21);
var showLabels = new Array('Artist', 'Artist ID', 'Work', 'Work Year', 'Exhibition Space', 'Exhibition', 'Exhibition Number', 'Exhibition Year', 'Country', 'City', 'Exhibition from US', 'Museum Exhibition', 'Abstract Expressionism', 'Only US Artists', 'Pop Art', 'Solo Show', 'Other');

var searchParameters = new Array('artistsName','artistsId','worksName','worksYear','exhibition_spacesName','exhibitionsExhib_name','exhibitionsExhib_number','exhibitionsExhib_year','countriesName','citiesName','exhibitionsExhib_from_us','exhibitionsIsmuseum','exhibitionsAbstractexpress','exhibitionsOnlyus','exhibitionsPopart','exhibitionsNeodada','exhibitionsMinimal');
var searchParametersPins = new Array(1, 0, 35, 36, 9, 13, 12, 14, 7, 3, 26, 24, 17, 25, 20, 19, 21);
var searchParametersValues = new Array('','','','','','','','','','','','','','','','','');
var searchParametersTable = new Array('artists', 'artists', 'works', 'works', 'exhibition_spaces', 'exhibitions', 'exhibitions', 'exhibitions', 'countries', 'cities', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions');
var searchParametersColumns = new Array('name', 'id', 'name', 'year', 'name', 'exhib_name', 'exhib_number', 'exhib_year', 'name', 'name', 'exhib_from_us', 'ismuseum', 'abstractexpress', 'onlyus', 'popart', 'neodada', 'minimal');

var selectedData = new Array();

var editSQLqueries = new Array();
var editQueriesCount = 0;

var tables = new Array('artists', 'artists', 'works', 'works', 'exhibition_spaces', 'exhibitions', 'exhibitions', 'exhibitions', 'countries', 'cities', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions', 'exhibitions');
var columns = new Array('name', 'id', 'name', 'year', 'name', 'exhib_name', 'exhib_number', 'exhib_year', 'name', 'name', 'exhib_from_us', 'ismuseum', 'abstractexpress', 'onlyus', 'popart', 'neodada', 'minimal');
var data = new Array();
var dataAll = 0;

/* Suggestions on Key Up */
function suggest(val, id) {
	// Define String trim function
	String.prototype.trim = function () { return this.replace(/^\s*/, "").replace(/\s*$/, ""); }
	
	// If there is no value in the textbox
	if (val == "") {
		document.getElementById("suggestions").style.display = "none";
		document.getElementById("suggestions").innerHTML = "";
		document.getElementById(id).style.borderColor = "#000000";
		return;
	}
	
	// Get all possible suggestions
	var suggestions = "";

	// Loop through the proper data
	for (var key in data[id]) {
		var obj = data[id][key];
		for (var prop in obj) {
			var name = obj[prop].toLowerCase().trim();
			var valL = val.toLowerCase().trim();
			var add = true;
			
			var doubles = suggestions.split(" , ");
			for(var i=0; i<doubles.length; i++) {
				if(doubles[i] == obj[prop]) { add=false; }
			}
			if(add && valL.localeCompare(name.substring(0,valL.length)) == 0) {
				if(suggestions.localeCompare("") == 0) { suggestions = obj[prop]; }
				else { suggestions += " , " + obj[prop];}
			}
		}
	}
	
	// Display suggestions
	if(suggestions == "") {
		document.getElementById("suggestions").style.display = "none";
		document.getElementById(id).style.borderColor = "red";
	} else {
		document.getElementById("suggestions").innerHTML = suggestions;
		document.getElementById("suggestions").style.display = "block";
		document.getElementById("suggestions").style.borderColor = "green";
		document.getElementById(id).style.borderColor = "green";
	}
}

/* Check on Blur */
function check(val, id) {
	document.getElementById("suggestions").style.display = "none";
	if (val == "") {
		document.getElementById("suggestions").style.display = "none"; document.getElementById("suggestions").innerHTML = "";
		document.getElementById(id).style.borderColor = "#000000";
		return;
	}
	
	var valid = "";
	for (var key in data[id]) {
		var obj = data[id][key];
		for (var prop in obj) {
			// Flexibility of comparison (Trim, Lowercase, SpecialCharacthers)
			var nameCompare = obj[prop].toLowerCase().trim();
			var valCompare = val.toLowerCase().trim();
			if(valCompare == nameCompare) { valid = obj[prop]; }
		}
	}
	if(valid != "") {
		document.getElementById(id).style.borderColor = "green";
		document.getElementById(id).value = valid;
		return true;
	} else {
		document.getElementById(id).style.borderColor = "red";
		return false;
	}
}


function checkbox(id) {
	var element = document.getElementById(id);
	if(element.innerHTML == 'show') {
		element.innerHTML = 'hide';
		element.style.color = 'red';
	} else {
		element.innerHTML = 'show';
		element.style.color = 'green';
	}
}

function rowClick(id) {
	rowElement = document.getElementById(id);
	radioElement = document.getElementById(id+'radio');
	if(radioElement.checked == true) {
		radioElement.checked = false;
		rowElement.style.backgroundColor = "transparent";
	} else {
		radioElement.checked = true;
		rowElement.style.backgroundColor = "rgba(150,150,150,0.7)";
	}	
}











function read() {
	find();
	display('read');
}

function find() {
	// Get the search parameters
	for(var v=0; v<searchParameters.length; v++) {
		searchParametersValues[v] = document.getElementById(searchParameters[v]).value;
	}
	
	// Create new data set based on parameters
	var rowCount = 0;
	selectedData = new Array();
	for(var n=0; n<dataAll.length; n++) {
		var addRow = true;
		for(var g=0; g<searchParameters.length; g++) {
			if(searchParametersValues[g] != '' && searchParametersValues[g] != dataAll[n][searchParametersPins[g]]) { addRow = false; }
		}
		if(addRow) { selectedData[rowCount] = dataAll[n]; rowCount++; }
	}
}

function display(type) {
	// Create HTML String
	var html = "<table>";
	
	// Add Column Labels Code
	html += "<tr id='columnLabels'>";
	for(var s=0; s<showLabels.length; s++) {
		html += "<td>" + showLabels[s] + "</td>";
	}
	html += "</tr>"
	
	// Display proper columns from selected data
	for(var row=0; row<selectedData.length; row++) {
		html += "<tr id='row" + row + "' class='rows' onclick='rowClick(this.id);'>";
		for(var col=0; col<showPins.length; col++) {
			if(type == 'read') { html += "<td>" + selectedData[row][showPins[col]] + "</td>"; }
			else if(type == 'edit') { html += "<td><input type='text' id='" + searchParameters[col] + row + "' onchange='editField(this," + row + "," + col + ")' value='" + selectedData[row][showPins[col]] + "' /></td>"; }
		}
		html += "</tr>";
	}
	html += "</table>";
	
	// Display HTML
	document.getElementById('displayForm').innerHTML = html;
	document.getElementById('display').style.display = "block";
}

function edit() {
	// Display data for editing
	display('edit');
	
	// Change buttons to Save & Cancel
	document.getElementById('editButton').innerHTML = 'Save';
	document.getElementById('editButton').onclick = editSave;
	document.getElementById('deleteButton').innerHTML = 'Cancel';
	document.getElementById('deleteButton').onclick = editCancel;
}

function editCancel() {
	// Display data for reading
	display('read');
	
	// Change buttons to Edit & Delete
	document.getElementById('editButton').innerHTML = 'Edit';
	document.getElementById('editButton').onclick = edit;
	document.getElementById('deleteButton').innerHTML = 'Delete';
	document.getElementById('deleteButton').onclick = deleteRow;
}

function editSave() {
	for(var e=0; e<editSQLqueries.length; e++) {
		document.getElementById("query").src = "query.php?q=" + editSQLqueries[e];
	}
	
}

function editField(element, row, col) {
	// Old value
	var oldValue = selectedData[row][showPins[col]];
	// New value
	var newValue = element.value;
	
	
	//if(searchParameters[col] == 'artistsName') { editArtistsName(oldValue, newValue, row, col); }
	//else if(searchParameters[col] == 'artistsId') { editArtistsId(oldValue, newValue, row, col); }
	if(searchParameters[col] == 'exhibitionsExhib_number' || searchParameters[col] == 'exhibitionsExhib_year' || searchParameters[col] == 'exhibitionsExhib_from_us' || searchParameters[col] == 'exhibitionsIsmuseum' || searchParameters[col] == 'exhibitionsAbstractexpress' || searchParameters[col] == 'exhibitionsOnlyus' || searchParameters[col] == 'exhibitionsPopart' || searchParameters[col] == 'exhibitionsNeodada' || searchParameters[col] == 'exhibitionsMinimal') { 
		editExhibitions(oldValue, newValue, row, col); 
	}
	//else if(searchParameters[col] == 'countriesName') { editCountry(oldValue, newValue, row, col); }
	//else if(searchParameters[col] == 'citiesName') { editCity(oldValue, newValue, row, col); }
	
	
}

function editArtistsName(oldValue, newValue, row, col) {
	// Get exhibition ID
	var exhibitionID = selectedData[row][11];
	
	// Get old artistsID
	var oldArtistsID = selectedData[row][0];

	// Clear?
	var clear = false;
	if(oldValue == newValue) {clear = true;}
	
	// Check for affected values
	for(var s=0; s<selectedData.length; s++) {
		if(selectedData[s][11] == exhibitionID && selectedData[s][1] == oldValue) { 
			if(clear) { document.getElementById("artistsName" + s).style.borderColor = "black"; document.getElementById("artistsId" + s).style.borderColor = "black"; }
			else { document.getElementById("artistsName" + s).style.borderColor = "red"; document.getElementById("artistsId" + s).style.borderColor = "red"; }
		}
	}
	
	// Check if new artistName already exists
	var exists = false;
	var id = 0;
	for(var c=0; c<dataAll.length; c++) {
		if(dataAll[c][1] == newValue) { exists = true; id = dataAll[c][0]; }
	}	

	// If exists, link to that artists
	if(exists) { editSQLqueries[editQueriesCount] = "UPDATE exhibitions_has_artists SET fk_artists_id=" + id + " WHERE fk_exhibitions_id=" + exhibitionID + " fk_artists_id=" + oldArtistsID; editQueriesCount++; }
	// Else create new artist and link to new artist
	else { 
		editSQLqueries[editQueriesCount] = "INSERT INTO artists (name) VALUES ('" + newValue + "')"; editQueriesCount++;
		// Find last ID
		var newID = 0;
		for (var key in data['exhibitions_has_artistsFk_artists_id']) {
			var obj = data['exhibitions_has_artistsFk_artists_id'][key];
			for (var prop in obj) {
				if(obj[prop] > newID) { newID = obj[prop]; }
			}
		}
		//newID = data['artistsId'][data['artistsId'].length-1]+1;
		editSQLqueries[editQueriesCount] = "UPDATE exhibitions_has_artists SET fk_artists_id=" + newID + " WHERE fk_exhibitions_id=" + exhibitionID + " fk_artists_id=" + oldArtistsID; editQueriesCount++;
	}
}

function editArtistsId(oldValue, newValue, row, col) {
	// Get exhibition ID
	var exhibitionID = selectedData[row][11];
	
	// Clear?
	var clear = false;
	if(oldValue == newValue) {clear = true;}
	
	// Get old artistsName
	var oldArtistsName = selectedData[row][1];
	
	// Check for affected values
	for(var s=0; s<selectedData.length; s++) {
		if(selectedData[s][11] == exhibitionID && selectedData[s][0] == oldValue) { 
			if(clear) { document.getElementById("artistsName" + s).style.borderColor = "black"; document.getElementById("artistsId" + s).style.borderColor = "black"; }
			else { document.getElementById("artistsName" + s).style.borderColor = "red"; document.getElementById("artistsId" + s).style.borderColor = "red"; }
		}
	}
	
	// Check if new artistId already exists
	var exists = false;
	var id = 0;
	for(var c=0; c<dataAll.length; c++) {
		if(dataAll[c][0] == newValue) { exists = true; id = dataAll[c][0]; }
	}
	
	// If exists, link to that artistID
	if(exists) { editSQLqueries[editQueriesCount] = "UPDATE exhibitions_has_artists SET fk_artists_id=" + id + " WHERE fk_exhibitions_id=" + exhibitionID + " fk_artists_id=" + oldValue; editQueriesCount++; }
	// Else create new artist and link to new artist
	else { 
		editSQLqueries[editQueriesCount] = "INSERT INTO artists (name) VALUES ('" + oldArtistsName + "')"; editQueriesCount++;
		newID = data['artistsId'][data['artistsId'].length-1]+1;
		editSQLqueries[editQueriesCount] = "UPDATE exhibitions_has_artists SET fk_artists_id=" + newID + " WHERE fk_exhibitions_id=" + exhibitionID + " fk_artists_id=" + oldValue; editQueriesCount++;
	}
}

function editCountry(oldValue, newValue, row, col) {
	// Get exhibition ID
	var exhibitionID = selectedData[row][11];
	
	// Clear?
	var clear = false;
	if(oldValue == newValue) {clear = true;}
	
	// Get old cityID
	var oldCityID = selectedData[row][2];
	
	// Check for affected values
	for(var s=0; s<selectedData.length; s++) {
		if(selectedData[s][11] == exhibitionID && selectedData[s][7] == oldValue) { 
			if(clear) { document.getElementById("countriesName" + s).style.borderColor = "black"; }
			else { document.getElementById("countriesName" + s).style.borderColor = "red"; }
		}
	}
	
	// Check if new country already exists
	var exists = false;
	var id = 0;
	for(var c=0; c<dataAll.length; c++) {
		if(dataAll[c][7] == newValue) { exists = true; id = dataAll[c][5]; }
	}
	
	// If exists, link to that artistID
	if(exists) { editSQLqueries[editQueriesCount] = "UPDATE cities SET fk_countries_id=" + id + " WHERE id=" + oldCityID; editQueriesCount++; }
	// Else create new artist and link to new artist
	else { 
		editSQLqueries[editQueriesCount] = "INSERT INTO countries (name) VALUES ('" + newValue + "')"; editQueriesCount++;
		newID = data['artistsId'][data['artistsId'].length-1]+1;
		editSQLqueries[editQueriesCount] = "UPDATE cities SET fk_countries_id=" + newID + " WHERE id=" + oldCityID; editQueriesCount++;
	}
	
}

function editExhibitions(oldValue, newValue, row, col) {
	// Get exhibition ID
	var exhibitionID = selectedData[row][11];	
	
	// Clear?
	var clear = false;
	if(oldValue == newValue) {clear = true;}

	// Check for affected values
	for(var s=0; s<selectedData.length; s++) {
		if(selectedData[s][11] == exhibitionID && selectedData[s][searchParametersPins[col]] == oldValue) { 
			if(clear) { document.getElementById(searchParameters[col] + s).style.borderColor = "black"; }
			else { document.getElementById(searchParameters[col] + s).style.borderColor = "red"; }
		}
	}
	
	editSQLqueries[editQueriesCount] = "UPDATE exhibitions SET " + searchParametersColumns[col] + "=" + newValue + " WHERE id=" + selectedData[row][11]; editQueriesCount++;
}



function deleteRow(row, col) {
	// Get exhibition ID
	var exhibitionID = selectedData[row][11];
	
	// Check if there are multiple lines with the same exhibition ID
	var numOfEIDs = 0;
	for(var a=0; a<dataAll.length; a++) {
		if(dataAll[a][11] == exhibitionID) { numOfEIDs++; }
	}
	
	// If this is the only line with this exhibitions ID
	if(numOfEIDs == 1) {
		// DELETE FROM exhibitions WHERE id = exhibitionID
	} 
	// If not, then DO NOT delete from exhibitions!
	else {
		
	}
	
	// Check if there is more than one exhibition number in the datalist
		// If not delete the exhibition and all connections
		
		// If there is more
			// Check if there is more than one of the same artistID in the exhibition
			// If not delete the artist id / exhibition connection
		
			// If there is more
			// Check if there is more than 
			
			
		
}
