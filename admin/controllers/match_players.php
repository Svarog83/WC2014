<?

$select_game = ( isset ( $select_game ) ? intval( $select_game ) : 0 );
$select_user = ( isset ( $select_user ) ? intval( $select_user ) : 0 );
$status = ( isset ( $status ) ? intval( $status ) : 0 );

if ( $select_game && $select_user )
{
	$query = "DELETE FROM game_user_link WHERE gul_user = '$select_user' && gul_game = '$select_game'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	
	$query = "
		INSERT INTO
	game_user_link
		SET
	gul_user = '$select_user', 
	gul_game = '$select_game',
	gul_go 	 = '$status',
	gul_remarks = 'Поменял {$UA['user_fam']}'
	";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}

$TeamsArr  = getTeams();

if ( $select_game )
{
	$query = "SELECT * FROM game WHERE g_id = '$select_game'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	$MatchArr = mysql_fetch_array( $result, MYSQL_ASSOC );
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
	else 
	{
		$PlayersArr['bad'][] = $row;
	}
}

$EmailsArr = array();

$query = "SELECT * FROM email WHERE em_game = '$select_game'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) )
{
	$EmailsArr[$row['em_user']] = true;
}