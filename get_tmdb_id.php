<html>
<head><title>Local Media Library</title></head>
<body>
<a href="overview.php">Overview</a>
<a href="series_add.php">Add a series</a>
<a href="movie_add.php">Add a movie</a>
<form method="post" action="get_tmdb_id.php">
    <table border="1">
        <tr>
            <td colspan="2" align="center">This page allows you to get the movie-id from themoviedb.org by title.</td>
        </tr>
        <tr align="center">
            <td>Title</td>
            <td>Year (opt)</td>
            <td></td>
        </tr>
        <tr align="center">
            <td><input type="text" name="title"></td>
            <td><input type="number" name="year"></td>
            <input type="hidden" value="1" name="sent" />
            <td><input type="submit"></td>
        </tr>
    </table>
</form>
    <form method="post" action="get_tmdb_id.php">
    <table>
        <tr><td>Interne Datenbank mit TMDB abgleichen und ggf. aktualisieren?</td></tr>
        <tr><td><input type="hidden" value="1" name="updatedb" />
            <td><input type="submit"></td></tr>
    </table>
    </form>



<?php
include 'database.php';

if( isset($_POST['sent'])) {
  static $url = 'http://api.themoviedb.org/3/';
  static $api_key='8eae445981f70f12cb680676146f6abc';

    $title = $_POST['title'];
    $year = $_POST['year'];


        if ( $year == '') {
            $call = file_get_contents("$url" . "search/movie" . "?api_key=" . $api_key . "&query=" . $title);
        }
        else {
            $call = file_get_contents("$url" . "search/movie" . "?api_key=" . $api_key . "&query=" . $title . "&year=" . $year);
        }
			$json = json_decode($call, true); //This will convert it to an array
    echo '<table border="1">';
    echo' <tr>
            <td align="center">Title</td>
            <td align="center">Release</td>
            <td align="center">TMDB - ID</td>
        </tr>';

      //  $movie_title = $json['results'][$x]['title'];
      //  $movie_year = $json['results'][$x]['release_date'];
      //  $movie_id = $json['results'][$x]['id'];
    foreach($json['results'] as $movie)
    {
        echo '<tr>';
        echo "<td align=\"center\">".$movie['title']."</td>";
        echo "<td align=\"center\">".$movie['release_date']."</td>";
        echo "<td align=\"center\">".$movie['id']."</td>";
        echo '</tr>';
    }
    echo '</table>';
}

if( isset($_POST['updatedb'])) {
    static $url = 'http://api.themoviedb.org/3/';
    static $api_key='8eae445981f70f12cb680676146f6abc';

    mysql_connect("$dbhost", "$dbuser" , "$dbpass") or die ('Connection not possible');
    mysql_select_db("$dbname") or die ('Database did not exist');

    $sql = 'SELECT title FROM media_movies';
    $d = mysql_query($sql);
    // Array setzten
    $daten = array();

    while($data = mysql_fetch_row($d)) {
        array_push($daten, $data[0]);
    }

    foreach($daten as $elem){

        $call = file_get_contents("$url" . "search/movie" . "?api_key=" . $api_key . "&query=" . urlencode($elem));
        $json = json_decode($call, true);
        if ( count($json['results']) == 1) {
            $movie_title = $json['results']['0']['title'];
            $movie_release = $json['results']['0']['release_date'];
            $movie_id = $json['results']['0']['id'];
            $movie_average_vote = $json['results']['0']['vote_average'];
            $movie_original_title = $json['results']['0']['original_title'];
            $movie_poster_path = "http://image.tmdb.org/t/p/w500" . $json['results']['0']['poster_path'];

            $movie_title = mysql_real_escape_string($movie_title);
            $movie_release = mysql_real_escape_string($movie_release);
            $movie_id = mysql_real_escape_string($movie_id);
            $movie_average_vote = mysql_real_escape_string($movie_average_vote);
            $movie_original_title = mysql_real_escape_string($movie_original_title);
            $movie_poster_path = mysql_real_escape_string($movie_poster_path);
            $elem = mysql_real_escape_string($elem);


           // echo "title: ".$movie_title."<br />";
           // echo "release: ".$movie_release."<br />";
           // echo "id: ".$movie_id."<br />";
           // echo "vote: ".$movie_average_vote."<br />";
           // echo "org title: ".$movie_original_title."<br />";
           // echo "poster: ".$movie_poster_path."<br />";



           // $format = "UPDATE media_movies SET tmdb_id = '%s', release = '%s', average_vote = '%s', original_title = '%s', poster_path = '%s' WHERE title = '%s'";
            $format = "UPDATE `media_movies` SET `tmdb_id` = '%s' , `release` = '%s' , `average_vote` = '%s' , `original_title` = '%s' , `poster_path` = '%s' WHERE `title` = '%s'";

            $query = sprintf($format, $movie_id, $movie_release, $movie_average_vote, $movie_original_title, $movie_poster_path, $elem);
           // echo $format . "<br />";
           // echo $query . "<br />";

            $insert =  mysql_query($query);

            if (!$insert)
            {
                die('Invalid invoice: ' . mysql_error());
            }
            else
            {
                echo $movie_title . " in DB eingetragen<br />";
            }
          //

        }
        else {
       //     foreach($json['results'] as $movie)
            //     {
            //         echo '<table border="1">';
            //         echo '<tr><td>' . $elem . '</td></tr>';
            //         echo '<tr>';
            //          echo "<td align=\"center\">".$movie['title']."</td>";
            //         echo "<td align=\"center\">".$movie['release_date']."</td>";
            //         echo "<td align=\"center\">".$movie['id']."</td>";
            //         echo '</tr>';
            //         echo '</table>';
            }
        }







    // $call = file_get_contents("$url" . "search/movie" . "?api_key=" . $api_key . "&query=" . $title);

    // $json = json_decode($call, true); //This will convert it to an array

}

?>