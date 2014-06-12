<?

$query = "SELECT * FROM game WHERE ";

if ( $select_team )
	$query .= "( g_team1 = '$select_team' || g_team2 = '$select_team' ) && ";

if ( $select_tour )
	$query .= " g_tour = '$select_tour' && ";
	
$query .= " 1 ORDER BY g_tour, g_date_time, g_id";

$MatchesArr  = array();
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	$MatchesArr[] = $row;
}


$PlayersArr = array();

$query = "SELECT gul_game, COUNT(*) AS cnt FROM game_user_link WHERE gul_go = 1 GROUP BY gul_game";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) )
	$PlayersArr['good'][$row['gul_game']] = $row['cnt'];
	
$TeamsArr = getTeams();