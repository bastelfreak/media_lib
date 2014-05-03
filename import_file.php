<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
include 'database.php';

mysql_connect("$dbhost", "$dbuser" , "$dbpass") or die ('Connection not possible');
mysql_select_db("$dbname") or die ('Database did not exist');

// Name der Textdatei
$datei = "dbdumb";

// Liest eine Datei komplett in ein Array (z.b. $lines) ein 
$lines = file($datei);

// auslesen 
foreach($lines as $v) {
    $insert = mysql_query("INSERT INTO media_movies (title) VALUES ('" . $v . "')");
    if (!$insert)
    {
        die('Invalid invoice: ' . mysql_error());
    }
    else
    {
        echo $v ." succesfully added.<br />";
    }
}

?>