<?php
# functions.php
# created by Tim 'bastelfreak' Meusel <tim@bastelfreak.de>
# #
# 2014-05-03 initial creation, added first function

/*
*
*
*/
function get_mysqli($charset = false){
	global $dbhost;
	global $dbuser;
	global $dbpass;
	global $dbname;
	if($charset === false OR !is_string($charset)){
		$charset = 'utf8';
	}
	$mysqli = mysqli_init();
	if($mysqli->real_connect($dbhost, $dbuser, $dbpass, $dbname)){
		unset($host);
		unset($user);
		unset($password);
		unset($database);
		$mysqli->query("SET 
			character_set_results = '".$charset."', 
			character_set_client = '".$charset."', 
			character_set_connection = '".$charset."', 
			character_set_database = '".$charset."', 
			character_set_server = '".$charset."'
		");
		return $mysqli;
	}else{
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
}

/*
* gets latest series or movies ordered by rating as fancy html table
* params $type - media_movies or media_series
* params $limit - int value for number of db entries to select
*/
function get_content($type, $limit = 0){
	$allowed_types = Array('media_movies', 'media_series');
	$mysqli = get_mysqli();
	$type = $mysqli->real_escape_string($type);
	$limit = $mysqli->real_escape_string($limit);
	$output = '';
	if($limit == 0){
		$limit = '';
	}elseif($limit >= 1){
		$limit = 'LIMIT '.$limit;
	}
	if(in_array($type, $allowed_types)){
		$query = "SELECT `index`, `title`, `rating`, `length` FROM `".$type."` ORDER BY `rating` DESC ".$limit;
		$result = $mysqli->query($query);
		$output .= "<table id='".$type."' class='display' cellspacing='0' width='100%'>\n";
		$output .= "<thead>\n";
		$output .= "<tr>\n";
		$output .= "<th>Datenbankeintrag</th>\n";
		$output .= "<th>Titel</th>\n";
		$output .= "<th>Bewertung</th>\n";
		$output .= "<th>L&auml;nge</th>\n";
		$output .= "</tr>\n";
		$output .= "</thead>";
		$output .= "<tbody>\n";
		while($data = $result->fetch_object()){
			$output .= "<tr>\n";
			$output .= "<td>".$data->index."</td>\n";
			$output .= "<td>".$data->title."</td>\n";
			$output .= "<td>".$data->rating."</td>\n";
			$output .= "<td>".$data->length."</td>\n";
			$output .= "</tr>\n";
		}
		$result->close();
		$output .= "</tbody>\n";
		$output .= "<tfoot>\n";
		$output .= "<tr>\n";
		$output .= "<th>Datenbankeintrag</th>\n";
		$output .= "<th>Titel</th>\n";
		$output .= "<th>Bewertung</th>\n";
		$output .= "<th>L&auml;nge</th>\n";
		$output .= "</tr>\n";
		$output .= "</tfoot>";
		$output .= "</table>\n";
		return $output;
	}
}
?>
