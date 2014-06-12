<?
$login_success = false;

$query = "SELECT * FROM user WHERE user_pwd = '$add_pwd' && user_login = '$login' && user_state = 'a'  ";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

if ( mysql_num_rows( $result ) == 1 )
{
    $login_success = true;
    $UA = mysql_fetch_array( $result, MYSQL_ASSOC );
    
    session_start();
    SetSessionData( $UA['user_id'], $setup_secret_word );
    
    $query = "UPDATE user SET user_login_dtm = '" . date ( "Y-m-d H:i:s" ) . "' WHERE user_id = '" . $UA['user_id'] . "'";
    $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
    redirect();
}
