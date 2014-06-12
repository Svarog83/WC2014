<?

$query = "SELECT * FROM user WHERE ";

if ( $select_user )
	$query .= "user_id = '$select_user' && ";

if ( $user_login )
	$query .= "user_login LIKE '$user_login%' && ";

if ( $user_role )
	$query .= "user_role = '$user_role' && ";
	
if ( $user_state )
	$query .= "user_state = '$user_state' && ";
	

	
$query .= " 1";

$UsersArr  = array();
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	$UsersArr[] = $row;
}