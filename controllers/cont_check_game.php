<?
if ( !checkRights ( array ( 'user' ) ) ) redirect( '/no_admission/' );

$select_game = (int)$GLOBAL_PARAMS[1];

$error_message = array();

$query = "SELECT * FROM game WHERE g_id = '" . $select_game . "'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
$GA = mysql_fetch_array ( $result, MYSQL_ASSOC );
if ( !$GA )
	$error_message[] = 'Такая игра не найдена!';
else 
{
	$MA = array();

	$query = "SELECT * FROM game_user_link WHERE gul_user = '" . $UA['user_id'] . "' && gul_game = '" . $select_game . "'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	$MA = mysql_fetch_array ( $result, MYSQL_ASSOC );
}

$PlayersArr = array();
$PlayersArr['good'] = $PlayersArr['bad'] = array();
$query = "SELECT user_id, user_name, user_fam, user_email, gul_id, gul_go, gul_remarks FROM user LEFT JOIN game_user_link ON gul_user = user_id && gul_game = '$select_game' ORDER BY user_name";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) )
{
	if ( $row['gul_go'] )
	{
		$PlayersArr['good'][] = $row;
	}
	else if ( !$row['gul_go'] && $row['gul_id'] )
	{
		$PlayersArr['bad'][] = $row;
	}


}

