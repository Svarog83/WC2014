<?
$select_game = ( isset ( $select_game ) ? intval( $select_game ) : 0 );

$TeamsArr  = getTeams();

if ( $select_game )
{
	$query = "SELECT * FROM game WHERE g_id = '$select_game'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	$MatchArr = mysql_fetch_array( $result, MYSQL_ASSOC );
}

