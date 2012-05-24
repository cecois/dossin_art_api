<!--

THIS IS THE MAIN GUI FILE.
IT CONTAINS THE CONNECTIONS TO THE REMAINING GUI FILES.
THIS FILE IS PRIMARILY MEANT FOR HTML CODING

-->

<!doctype html>
<html>

	
	<head>
		<title>Dossin Art Search</title>
		<?php include 'lib/gui_server.php'; ?>  <!-- PHP FILE - contains php code that connects to the postgreSQL database and obtains data -->
		<script src="lib/gui_client.js" type="text/javascript"></script>  <!-- JAVASCRIPT FILE - contains javascript code that performs client side operations based on the user interaction (no connection to database is made in javascript, that is all PHP based) -->
		<link rel="stylesheet" href="css/gui.css" media="screen" />  <!-- CSS FILE - styling the look of the gui -->
		
		<!-- Transfer data obtained from PHP to usable javascript variables. This code NEEDS to be in a php file within the <script></script> tags due to the javascript/php combo coding -->
		<script type="text/javascript">
			function loadData() {
				data['artistsName'] = <?php echo $artistsName; ?>;
				data['artistsId'] = <?php echo $artistsId; ?>;
				data['worksName'] = <?php echo $worksName; ?>;
				data['worksYear'] = <?php echo $worksYear; ?>;
				data['exhibition_spacesName'] = <?php echo $exhibition_spacesName; ?>;
				data['exhibitionsExhib_name'] = <?php echo $exhibitionsExhib_name; ?>;
				data['exhibitionsExhib_number'] = <?php echo $exhibitionsExhib_number; ?>;
				data['exhibitionsExhib_year'] = <?php echo $exhibitionsExhib_year; ?>;
				data['countriesName'] = <?php echo $countriesName; ?>;
				data['citiesName'] = <?php echo $citiesName; ?>;
				data['exhibitions_has_artistsFk_artists_id'] = <?php echo $exhibitions_has_artistsFk_artists_id; ?>;
				dataAll = <?php echo $allData; ?>;
			}
		</script>
		
	</head>

	
	
	<body onload="loadData()"> <!-- Loads all of the data that javascript will use before the webpage is fully displayed -->
	
		<!-- Form that is shown on screen -->
		<form id="search">
			<h3><span>Triumph of American Art in Europe Dataset</span></h3>
			<div id="searchOptions">
				
				<!-- Each column of search boxes is within its own fieldset -->
				<fieldset>
					<!-- Each search box has a label, a span, and an input and they all follow the same format with different names and ids -->
					<!-- Label: nothing important, just a label -->
					<label for="artistsName">Artist Name</label>
					<!-- Span: this is used to create the show/hide option too the right of the label. A simple javascript code is combined with it-->
					<span id="artistsNameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<!-- Input: This has a VERY SPECIFIC ID of the format tableColumn (where the columns first letter is capatalized) -->
					<!-- Input: It also activates the suggestions whenever a key is up (onkeyup) and it finialized the input when focus is moved away from the checkbox (onblur)-->
					<input type="text" name="artistsName" id="artistsName" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
					<label for="artistsId">Artist ID</label><span id="artistsIdC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="artistsId" id="artistsId" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
				</fieldset>

				<fieldset>
					<label for="worksName">Work Title</label><span id="worksNameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="worksName" id="worksName" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
					<label for="worksYear">Work Year</label><span id="worksYearC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="worksYear" id="worksYear" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
				</fieldset>

				<fieldset>
					<label for="exhibition_spacesName">Exhibition Space</label><span id="exhibition_spacesNameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="exhibition_spacesName" id="exhibition_spacesName" class="searchText" size="30"  onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />																										
					<label for="countriesName">Country</label><span id="countriesNameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="countriesName" id="countriesName" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />		
					<label for="citiesName">City</label><span id="citiesNameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="citiesName" id="citiesName" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
				</fieldset>	

				<fieldset>
					<label for="exhibitionsExhib_name">Exhibition Title</label><span id="exhibitionsExhib_nameC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="exhibitionsExhib_name" id="exhibitionsExhib_name" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
					<label for="exhibitionsExhib_number">Exhibition Number</label><span id="exhibitionsExhib_numberC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="exhibitionsExhib_number" id="exhibitionsExhib_number" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />
					<label for="exhibitionsExhib_year">Exhibition Year</label><span id="exhibitionsExhib_yearC" class="searchCheck" onclick="checkbox(this.id)">show</span>
					<input type="text" name="exhibitionsExhib_year" id="exhibitionsExhib_year" class="searchText" size="30" onkeyup="suggest(this.value, this.id)" onblur="check(this.value, this.id)" />					
				</fieldset>	

				<!-- This fieldset contains the dropdown menus for the 1/0s of the GUI, nothing big, but NOTE that the IDs follow the same format: tableColumn -->
				<fieldset>
					<table>
						<tr> </tr>
						<tr>
							<td>Exhibition from US</td><td><select id="exhibitionsExhib_from_us"><option></option><option>0</option><option>1</option></select></td>
							<td>Pop Art</td><td><select id="exhibitionsPopart"><option></option><option>0</option><option>1</option></select></td>
						</tr>
						<tr>
							<td>Museum Exhibition</td><td><select id="exhibitionsIsmuseum"><option></option><option>0</option><option>1</option></select></td>
							<td>Other</td><td><select id="exhibitionsMinimal"><option></option><option>0</option><option>1</option></select></td>
						</tr>
						<tr>
							<td>Only US Artists</td><td><select id="exhibitionsOnlyus"><option></option><option>0</option><option>1</option></select></td>
							<td>Solo Show</td><td><select id="exhibitionsNeodada"><option></option><option>0</option><option>1</option></select></td>
						</tr>
						<tr>
							<td>Abstract Expressionism</td><td><select id="exhibitionsAbstractexpress"><option></option><option>0</option><option>1</option></select></td>
						</tr>
					</table>
					
					<!-- Find and Add buttons simply call their corresponding javascript functions -->
					</br><button type="button" onclick="read()" style="float:right;"><b>Find</b></button><button type="button" id="addButton" onclick="display()" style="float:right;"><b>Add</b></button>				
				</fieldset>
			</div>
		</form>
		
		
		<!-- This is the section that displays the possible suggestions. Simply here for javascript to use and display. Styling is formatted with CSS -->
		<div id="suggestions"></div>
		
		<!-- Javascript takes care of displaying the correct data in a table -->
		<div id="display"><form id="displayForm"></form></div>
		
		<!-- Edit and Delete buttons -->
		<div id="buttons">
			<button type="button" id="editButton" onclick="edit()" style="float:right;">Edit</button>
			<button type="button" id="deleteButton" onclick="delete()" style="float:right;">Delete</button>
		</div>
		
		<!-- This iFrame is hidden and only used to process queries in PHP (THIS USES THE QUERY.PHP FILE WITH PARAMETERS SENT THROUGH THE URL) -->
		<iframe src="" id="query" style="display:none;"></iframe>
		
	</body>
</html>