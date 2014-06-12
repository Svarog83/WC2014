<?
$state = 'A';
$select_user = ( isset ( $_REQUEST['select_user'] ) ? intval( $_REQUEST['select_user'] ) : 0 );
$query = "SELECT * FROM user WHERE user_id = '$select_user'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
if ( mysql_num_rows( $result ) == 1 )
{
	$row = mysql_fetch_array( $result, MYSQL_ASSOC );
	
	$state = ( $row['user_state'] == 'a' ? 'b' : 'a' );
	$query = "UPDATE user SET user_state = '$state', user_state_dtm		= '" . date ( "Y-m-d H:i:s" ) . "' WHERE user_id = '$select_user'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}

echo strtoupper( $state );