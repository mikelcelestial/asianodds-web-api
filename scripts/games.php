<?php
/* ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1); */
require_once("../classes/Feeds.php");

$feeds = new Feeds();
$feeds_list = $feeds->listFeeds();

foreach($feeds_list AS $key => $sports) {
	
	$match = $feeds_list[$key]["MatchGames"];
	if(!empty($match)){
		foreach($match AS $m){
			
			$match_id[$m["MatchId"]] = $m["MatchId"];
			if (count(array_keys($match_id, $m["MatchId"])) <= 1)
			{
				$BookieOdds = (!empty($m["FullTimeOu"]["BookieOdds"])) ? $m["FullTimeOu"]["BookieOdds"] : $m["FullTimeHdp"]["BookieOdds"];
				$odds_arr = explode(";", $BookieOdds);
				$isLive = ($m["isLive"]!==1) ? 'Not Live' : 'Live';
				$match_name = $m["HomeTeam"]["Name"].' vs '.$m["AwayTeam"]["Name"];
				$schedule = $m["StartsOn"];
				$sports_type = ($m["SportsType"]!==2) ? 'Football' : 'Basketball';
				$isActive = ($m["isActive"]!==false) ? 'Active' : 'Not Active';
				$league = ucwords(strtolower($m["LeagueName"]));
				
				foreach($odds_arr AS $o){
					$output .= '<li>'.$o.'</li>';
					if( strpos( $o, 'BEST=' ) !== false ) {
						$best = str_replace('BEST=', '', $o);
					}
				}
				
				$share = 'https://www.facebook.com/dialog/feed?app_id=328553457519872&ref=site&display=page&name='.$sports_type.' Betting Tip&caption=Asianodds | The complete betting tool&description='.$match_name.'%0A'.$league.'%0ASchedule: '.$schedule.'%0ABest Odds: '.$best.'&picture=http://i.imgur.com/KT7wC6d.png&link=http://mklcentral.com/exam/scripts/games.php&redirect_uri=http://mklcentral.com/exam/scripts/games.php';
				$twitter = "http://twitter.com/share?text=Here’s an awesome betting tip from @asianconnect!&url=http://mklcentral.com/exam/scripts/games.php/&hashtags=betting,tip";
				
				$json["data"] = array(array("Sports" => $sports_type,
						  "Match ID" => $m["MatchId"],
						  "Match" => $m["HomeTeam"]["Name"].' vs '.$m["AwayTeam"]["Name"],
						  "Score" => $m["HomeTeam"]["Score"].' - '.$m["AwayTeam"]["Score"],
						  "Schedule" => $schedule,
						  "Odds" => $BookieOdds,
						  "League" => $league,
						  "Game Status" => $isLive,
						  "Place Bet?" => $isActive,
						  "Share" => $share,
						  "Twitter" => $twitter
				));
			}
		}
	}
}

//Test Data when API is offline
/* echo '{
  "data": [{
    "Sports":    "Basketball",
    "Match ID":    "123456",
    "Match":    "Houston Rockets vs Chicago Bulls",
    "Score":    "0 - 0",
    "Schedule":    "11/13/2016 01:00:00:000 PM",
    "Odds":    "PIN 0.952,IBC 0.960",
    "League":    "NBA",
    "Game Status":    "Not Live",
    "Place Bet?":   "Active",
    "Share":   "https://www.facebook.com/dialog/feed?app_id=328553457519872&ref=site&display=page&name=Basketball%20Betting%20Tip&caption=Asianodds%20|%20The%20complete%20betting%20tool&description=Houston%20Rockets%20vs%20Chicago%20Bulls%0A[NBA]%0ASchedule:%2011/13/2016%2001:00:00.000%20PM%0ABest%20Odds:%20PIN%200.952,IBC%200.960&picture=http://i.imgur.com/KT7wC6d.png&link=http://mklcentral.com/exam/index.php&redirect_uri=http://mklcentral.com/exam/index.php",
    "Twitter":   "http://twitter.com/share?text=Here’s an awesome betting tip from @asianconnect!&url=http://mklcentral.com/exam/index.php/&hashtags=betting,tip"
},
{
    "Sports":    "Basketball",
    "Match ID":    "78910",
    "Match":    "Los Angeles Lakers vs Cleveland Cavaliers",
    "Score":    "0 - 0",
    "Schedule":    "11/14/2016 01:00:00:000 PM",
    "Odds":    "PIN 0.942,IBC 0.970",
    "League":    "NBA",
    "Game Status":    "Not Live",
    "Place Bet?":   "Active",
    "Share":   "https://www.facebook.com/dialog/feed?app_id=328553457519872&ref=site&display=page&name=Basketball%20Betting%20Tip&caption=Asianodds%20|%20The%20complete%20betting%20tool&description=Los%20Angeles%20Lakers%20vs%20Cleveland%20Cavaliers%0A[NBA]%0ASchedule:%2011/14/2016%2001:00:00.000%20PM%0ABest%20Odds:%20PIN%200.942,IBC%200.970&picture=http://i.imgur.com/KT7wC6d.png&link=http://mklcentral.com/exam/index.php&redirect_uri=http://mklcentral.com/exam/index.php",
    "Twitter":   "http://twitter.com/share?text=Here’s an awesome betting tip from @asianconnect!&url=http://mklcentral.com/exam/index.php/&hashtags=betting,tip"
}
]
}'; */

echo json_encode($json);
?>