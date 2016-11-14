<?php
/* ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1); */
require_once("../classes/Feeds.php");

$feeds = new Feeds();
$league_list = $feeds->listLeagues();

$json = array("data" => array());
foreach($league_list AS $l) {
	$json["data"] = array(array("League ID" => $l["LeagueId"], "League Name" => $l["LeagueName"]));
}

echo json_encode($json);
?>