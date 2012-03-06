<!DOCTYPE html>
<html>
	<head>
		<title>GUI</title>
		<meta charset="utf-8" />
	</head>
<body>
	
	<h1>Read</h1>
	<form action="commands/readArtists.php">
		<fieldset>
			<legend>Artists</legend>
			Alphabetical Order: <input type="checkbox" name="alphabetical"></br>
			<input type="submit" name="submit" value="Retrieve">  
		</fieldset>
	</form>
	
	<form action="commands/readExhibitions.php">
		<fieldset>
			<legend>Exhibitions</legend>
			Start Year: <input type="text" name="startYear" size="10" length="10" >
			End Year: <input type="text" name="endYear" size="10" length="10" ></br>
			<input type="submit" name="submit" value="Retrieve"> 
			<input type="reset" name="reset" value="Clear"> 
		</fieldset>
	</form>
	
	<form action="commands/readWorks.php">
		<fieldset>
			<legend>Works</legend>
			Name: <input type="checkbox" name="name" >
			Year: <input type="checkbox" name="year" >
			Height: <input type="checkbox" name="height" >
			Width: <input type="checkbox" name="width" ></br>
			<input type="submit" name="submit" value="Retrieve"> 
			<input type="reset" name="reset" value="Clear"> 
		</fieldset>
	</form>
	
	
	
	
	<h1>Write</h1>
	<form action="commands/writeArtist.php" method="post">
		<fieldset>
			<legend>New Artist</legend>
			Artist Name: <input type="text" name="artistName" size="40" length="40" ><BR> 
			<input type="submit" name="submit" value="Submit"> 
			<input type="reset" name="reset" value="Clear"> 
		</fieldset>
	</form>


</body>
</html>