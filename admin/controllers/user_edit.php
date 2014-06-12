<?
$RolesArr  = getRoles();

$select_user = ( isset ( $select_user ) ? intval( $select_user ) : 0 );

$UserArr  = array();

if ( $select_user )
{
	$query = "SELECT * FROM user WHERE user_id = '$select_user'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	$UserArr = mysql_fetch_array( $result, MYSQL_ASSOC );
}
