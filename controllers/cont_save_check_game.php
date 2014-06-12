<?
$select_game 	= (int)$select_game;
$status 		= (int)$form_go;

$error_message = array();

$query = "SELECT * FROM game WHERE g_id = '" . $select_game . "'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
$GA = mysql_fetch_array ( $result, MYSQL_ASSOC );
if ( !$GA )
	$error_message[] = 'Такая игра не найдена!';
	
$query = "DELETE FROM game_user_link WHERE gul_user = '" . $UA['user_id'] . "' && gul_game = '$select_game'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

$query = "
	INSERT INTO
game_user_link
	SET
gul_user = '" . $UA['user_id'] . "', 
gul_game = '$select_game',
gul_go 	 = '$status',
gul_remarks = '" . $form_remarks . "'
";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

redirect( "/check_game/$select_game/");