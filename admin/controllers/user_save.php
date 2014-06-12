<?
$error_message  = array();

$select_user 	= ( isset ( $select_user ) ? intval( $select_user ) : 0 );
$edit_flag 	= ( $select_user ? 1 : 0 );

if( !$user_name )
{
	$error_message[] = 'Надо указать имя';
}

if( !$user_fam )
{
	$error_message[] = 'Надо указать фамилию';
}

if( !$user_login )
{
	$error_message[] = 'You did not enter login';
}
else if ( preg_match( "/[^a-z0-9_\-]/i", $user_login ) )
{
	$error_message[] = 'Login can only contain english letters, digits and "-" or "_"';
}
else if ( strlen( $user_login ) > 32 )
{
	$error_message[] = 'Login cannot be longer than 32 characters';
}
else if ( !$edit_flag )
{
	$query = "SELECT COUNT(*) as cnt FROM user WHERE user_login = '$user_login'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	$row = mysql_fetch_array( $result, MYSQL_ASSOC );
	if ( $row['cnt'] )
	{
		$error_message[] = 'Such login already exists!';
	}
}

if ( !count ( $error_message ) )
{
	$error_message = '';
	$query = 
	( $edit_flag ? "UPDATE" : "INSERT INTO" ) . 
	"
	user
		SET
	user_login 			= '$user_login',
	" . ( !$edit_flag ? "user_pwd = '" . md5 ( 'v' ) . "', " : '' ) . "
	user_name 			= '$user_name',
	user_fam 			= '$user_fam',
	user_email 			= '$user_email',
	user_create_dtm		= '" . date ( "Y-m-d H:i:s" ) . "',
	user_state			= '$user_state',
	user_state_dtm		= '" . date ( "Y-m-d H:i:s" ) . "',
	user_role			= '$user_role'
	" . ( $edit_flag ? "WHERE user_id = '$select_user'" : "" );
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}
else 
	$error_message = implode ( '<br>', $error_message );