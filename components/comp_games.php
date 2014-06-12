<?
$cMatchesArr = array();
$query = "SELECT * FROM game WHERE g_tour = '" . $S_TOUR . "' ORDER BY g_date_time, g_id";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) )
	$cMatchesArr[] = $row;
	
$cMatchResults = get_match_results( $UA['user_id'] );