<?
$error_message  = array();

$select_game 	= ( isset ( $select_game ) ? intval( $select_game ) : 0 );
$edit_flag 	= ( $select_game ? 1 : 0 );

if( !$g_tour )
{
	$error_message[] = 'Надо выбрать тур';
}

if( !$g_team1 )
{
	$error_message[] = 'Надо указать команду1';
}

if( !$g_team2 )
{
	$error_message[] = 'Надо указать команду2';
}

$year = date ( "Y", strtotime( $g_date_time ) );
$month = date ( "m", strtotime( $g_date_time ) );
$day = date ( "m", strtotime( $g_date_time ) );

if( strlen( $g_date_time ) < 10 || !checkdate( $month, $day, $year ) )
{
	$error_message[] = 'Неправильная дата';
}

if ( !count ( $error_message ) )
{
	$error_message = '';
	$query = 
	( $edit_flag ? "UPDATE" : "INSERT INTO" ) . 
	"
	game
		SET
	g_tour 			    = '$g_tour',
	g_team1 			= '$g_team1',
	g_team2 			= '$g_team2',
	g_date_time			= '$g_date_time',
	g_remarks 			= '$g_remarks',
	g_result 			= '$g_result'
	" . ( $edit_flag ? "WHERE g_id = '$select_game'" : "" );
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}
else 
	$error_message = implode ( '<br>', $error_message );