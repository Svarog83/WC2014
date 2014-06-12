<?
$user_authorized = false;
require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/config_main.php' );

$GLOBAL_PARAMS = array();
if ( isset ( $_SERVER['REDIRECT_URL'] ) ) 
{
	$GLOBAL_PARAMS = explode( '/', trim ( $_SERVER['REDIRECT_URL'], '/' ) );
	if ( isset ( $GLOBAL_PARAMS[0] ) ) 
		$todo = $GLOBAL_PARAMS[0];
}

$setup_cache_reset = ( isset ( $cache_reset ) ? (int)$cache_reset : 0 );

if ( $todo != 'login' )
	require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/check_security.php' );

if ( ( count ( $_POST ) || $UA['user_id'] == 16 ) && $todo != 'login' )
{
    $arr = array();
    $arr['ref'] = $_SERVER['HTTP_REFERER'];
    $arr['post'] = $_POST;
    $arr['get'] = $_GET;
    $arr['user'] = $UA;
    $arr['cookie'] = $_COOKIE;
    $arr['sesstion'] = $_SESSION;
    
    $query = "
        INSERT INTO
    log
        SET
    l_user_id = '{$UA['user_id']}',
    l_date    = '" . date ( "Y-m-d H:i:s" ) . "',
    l_log     = '" . mysql_real_escape_string( json_encode ( $arr ) ) . "'
        ";
    $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

}
	
$setup_time_start = microtime( true );

/*if ( !$todo && !$user_authorized )
    $todo = 'not_login';
else if ( !$todo && $user_authorized )
	$todo = 'list_users';*/

$dir_views = './views/';
$dir_controllers = './controllers/';

if ( !isset ( $todo ) || !$todo )
	$todo = 'index';

$todo = preg_replace( "/[^0-9a-z_]/", '', $todo );

$controller = 'cont_' . $todo . '.php';
$view       = 'view_' . $todo . '.php';

if ( $controller && file_exists( $dir_controllers . $controller ) )
    require_once( $dir_controllers . $controller );

$ajax_flag = isset( $ajax_flag ) ? true : false;
if ( !$ajax_flag )
    require_once( 'header.php' );

if ( $local_server && !$ajax_flag )
    require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/dBug.php' );  
    
if ( file_exists( $dir_views . $view ) )
    $file_name = $dir_views . $view;
else 
    $file_name = $dir_views . 'wrong_action.php';
    
require_once( $file_name );


$time_exec 	= microtime( true ) - $setup_time_start;
if ( !$ajax_flag )
    require_once( 'footer.php' );
