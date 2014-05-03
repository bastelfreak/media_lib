<?php 
# index.php
# 2014-05-03 Tim 'bastelfreak' Meusel <tim@bastelfreak.de> - complete rewrite, cleanup up old code, moved it to functions.php
error_reporting(E_ALL); 
ini_set( 'display_errors','1');
$rootPath = dirname(__FILE__);
require($rootPath.'/config.php');
require($rootPath.'/functions.php');
$latest_series = get_content('media_series');
$latest_movies = get_content('media_movies');
?>
<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel='stylesheet' type='text/css' href='css/jquery.dataTables.min.css'>
		<link rel='stylesheet' type='text/css' href='css/jquery.dataTables_themeroller.min.css'>
		<script type='text/javascript' src='js/jquery-2.1.1.min.js'></script>
		<script type='text/javascript' src='js/jquery.dataTables.min.js'></script>
		<script type='text/javascript' src='js/activate_tables.js'></script>
		<title>Local Media Library - Overview</title>
	</head>
	<body>
		<div>
			<?php echo $latest_series;?>
		</div>
		<div>
			<?php echo $latest_movies;?>
		</div>
	</body>
</html>
