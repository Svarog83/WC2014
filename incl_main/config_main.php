<?
require_once ( $_SERVER['DOCUMENT_ROOT'] .'/incl_main/setup.php' );

require_once ( $_SERVER['DOCUMENT_ROOT'] .'/functions/function_all.php' );

post_var_edit_final( '', 0 );

ini_set( 'MAX_EXECUTION_TIME', 1900 );

$connect_main = @mysql_connect( $db_host_name_main , $db_user_name_main , $db_password_main );

if( !$connect_main ) // ошибка подключения
{ 

echo '<center><br><br>&nbsp;&nbsp;Unfortunately the Database is not accessible now. The Server Administrator has been notified.<br><br><b><i>We are making our apologies</i></b><br><br>The Project pages cannot be viewed correctly without the DB access<br>Please relogin a bit later - we\'ll fix the problem in a moment</center>';

@mail( implode( ',', $admin_email ), 'DB_Main - Problems with MySQL', 
'
I couldn\'t connect with DB_Main

user: '. $user .'

GTracker' );

exit;

}

@mysql_select_db( $db_name_main, $connect_main );

$query = "SET NAMES 'utf8'";
$result = @mysql_query( $query )  or eu( __FILE__, __LINE__, $query );

$S_TOUR = 0;
$query = "SELECT * FROM setting";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
    $$row['sett_name'] = $row['sett_value'];
