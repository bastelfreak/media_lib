<html>
<head><title>Local Media Library - Overview</title></head>
<body align="center">
<?php 
include 'database.php';

 mysql_connect("$dbhost", "$dbuser" , "$dbpass") or die ('Connection not possible');
 mysql_select_db("$dbname") or die ('Database did not exist');	
 ?>
 Top 5 Movies by rating
 <?php
 $select = mysql_query("SELECT * FROM media_movies ORDER BY rating DESC LIMIT 5");
 
 if (!$select)
 {
 	die('Ungültige Abfrage: ' . mysql_error());
 }
 
 echo '<table border="1">';
 while ($zeile = mysql_fetch_array($select))
 {
 	echo "<tr>";
 	echo "<td>". $zeile['index'] . "</td>";
 	echo "<td>". $zeile['title'] . "</td>";
 	echo "<td>". $zeile['rating'] . "</td>";
 	echo "<td>". $zeile['length'] . "</td>";
 	echo "<td>". $zeile['genre'] . "</td>";
 	echo "<td>". $zeile['status'] . "</td>";
 	echo "</tr>";
 }
 echo "</table>";
 mysql_free_result( $select );
 ?>
 Top 5 Series by rating
<?php
 $select = mysql_query("SELECT * FROM media_series ORDER BY rating DESC LIMIT 5");
 
 if (!$select)
 {
 	die('Ungültige Abfrage: ' . mysql_error());
 }
 echo '<table border="1">';
 while ($zeile = mysql_fetch_array($select))
 {
 	echo "<tr>";
 	echo "<td>". $zeile['index'] . "</td>";
 	echo "<td>". $zeile['title'] . "</td>";
 	echo "<td>". $zeile['rating'] . "</td>";
 	echo "<td>". $zeile['length'] . "</td>";
 	echo "<td>". $zeile['genre'] . "</td>";
 	echo "<td>". $zeile['status'] . "</td>";
 	echo "</tr>";
 }
 echo "</table>";
 mysql_free_result( $select );
 
$url = file_get_contents("http://api.themoviedb.org/3/search/movie?api_key=8eae445981f70f12cb680676146f6abc&query=titanic");
	$json = json_decode($url, true); //This will convert it to an array
	$movie_title = $json['results']['0']['title'];
	$movie_year = $json['year'];
	echo $movie_title;
 
 if( isset($_POST['tmdb'])) 
{
	$url = file_get_contents("https://api.themoviedb.org/3/movie/550?api_key=8eae445981f70f12cb680676146f6abc");
	$json = json_decode($url, true); //This will convert it to an array
	$movie_title = $json['title'];
	$movie_year = $json['Year'];
	echo $movie_title;
 } 
 
?>