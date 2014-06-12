<?
$login_success = false;

$query = "SELECT * FROM user WHERE user_pwd = '$add_pwd' && user_login = '$login' && user_role = 'adm' && user_state = 'a'  ";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

if ( mysql_num_rows( $result ) == 1 )
{
    $login_success = true;
    $UA = mysql_fetch_array( $result, MYSQL_ASSOC );
    
    session_start();
    SetSessionData( $UA['user_id'], $setup_secret_word );
}
