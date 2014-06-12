<?
if ( !checkRights ( array ( 'user' ) ) ) redirect( '/no_admission/' );

$error_message = array();

$query = "SELECT COUNT(*) AS cnt FROM user WHERE user_login = '$login' && user_id != '{$UA['user_id']}'";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
$row = mysql_fetch_array ( $result, MYSQL_ASSOC );
$exist = $row['cnt'];

if ( $exist )
	$error_message[] = 'Такой логин уже существует!';
	
$query = "SELECT COUNT(*) AS cnt FROM user WHERE user_id = '{$UA['user_id']}' && user_pwd = '" . md5( $pwd_old ) . "' ";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
$row = mysql_fetch_array ( $result, MYSQL_ASSOC );
$correct_pass = $row['cnt'];

if ( $correct_pass != 1 )
	$error_message[] = 'Вы указали неправильный старый пароль!';
	
if ( $pwd != $pwd_2 )
	$error_message[] = 'Выбранные пароли не совпадают!';
	
if ( !$error_message )
{
	$query = "UPDATE user SET user_pwd = '" . md5( $pwd ) . "' WHERE user_id = '{$UA['user_id']}'";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	
	$success = true;
}