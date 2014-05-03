<html>
<head><title>Local Media Library</title></head>
<body>
<a href="overview.php">Overview</a>
<a href="series_add.php">Add a series</a>
<form method="post" action="movie_add.php">
<table>
	<tr>
		<td colspan="6" align="center">This page allows a manual insert of movie information.</td>
	</tr>
	<tr>
		<td colspan="6" align="center">PLEASE NOTE: This is only for movie information. Please do NOT add any series.</td>
	</tr>
	<tr align="center">
		<td>Title</td>
		<td>Length</td>
		<td>Genre</td>
		<td>Rating</td>
		<td>Status</td>
		<td></td>
	</tr>
	<tr>
		<td><input type="text" name="title"></td>
		<td><input type="number" name="length"></td>
		<td><input type="text" name="genre"></td>
		<td><input type="text" name="rating"></td>
		<td><input type="text" name="status"></td>
		<input type="hidden" value="1" name="sent" />
		<td><input type="submit"></td>
	</tr>
</table>

</form>

<?php 
include 'database.php';
if( isset($_POST['sent'])) 
{
	if( isset($_POST['title'], $_POST['rating'], $_POST['length'], $_POST['genre'], $_POST['status']))
		{ 
		mysql_connect("$dbhost", "$dbuser" , "$dbpass") or die ('Connection not possible');
		mysql_select_db("$dbname") or die ('Database did not exist');	
			
	 	$title = $_POST[title];
	 	$rating = $_POST[rating];
 	 	$length = $_POST[length];
 	 	$genre = $_POST[genre];
 	 	$status = $_POST[status];
  
	 	$insert = mysql_query("INSERT INTO media_movies (title, rating, length, genre, status) VALUES ('$title', '$rating', '$length', '$genre', '$status')");
 		if (!$insert) 
 		{
 	    	die('Invalid invoice: ' . mysql_error());
		}
	 	else 
	 	{
 			echo "The informations were added succesfully.";
	 	}
	}
	else 
	{
	 	echo 'Please do not leave any blank fields. This will confuse the database. It is very moody..';
    }
 }
 ?>

