<?
$user_authorized = false;

require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/config_main.php' );

if ( $todo != 'login' && $todo != 'not_login' )
	require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/check_security.php' );

if ( $user_authorized && $UA['user_role'] != 'adm' )
{
    echo '<h3>Хакер недоделанный, пшел нах. И чего тебе неймется:)?</h3>';
    exit();
}

$dir_views = './views/';
$dir_controllers = './controllers/';

if ( !$todo && !$user_authorized )
    $todo = 'not_login';
else if ( !$todo && $user_authorized )
	$todo = 'list_users';

$actions_arr  = array();
$action['not_login']['cont'] = 'not_login.php';
$action['not_login']['view']  = 'not_login.php';

$action['login']['cont'] = 'login.php';
$action['login']['view']  = 'login.php';

$action['list_users']['cont'] = 'list_users.php';
$action['list_users']['view']  = 'list_users.php';

$action['user_edit']['cont'] 	= 'user_edit.php';
$action['user_edit']['view']  	= 'user_edit.php';

$action['user_save']['cont'] 	= 'user_save.php';
$action['user_save']['view']  	= 'user_save.php';

//matches
$action['list_matches']['cont'] = 'list_matches.php';
$action['list_matches']['view'] = 'list_matches.php';

$action['match_edit']['cont'] 	= 'match_edit.php';
$action['match_edit']['view']  	= 'match_edit.php';

$action['match_save']['cont'] 	= 'match_save.php';
$action['match_save']['view']  	= 'match_save.php';

$action['match_players']['cont'] 	= 'match_players.php';
$action['match_players']['view']  	= 'match_players.php';

$action['email_send']['cont'] 		= 'email_send.php';
$action['email_send']['view']  		= 'match_players.php';

$action['settings']['cont'] 		= 'settings.php';
$action['settings']['view']  		= 'settings.php';

$action['save_settings']['cont'] 		= 'save_settings.php';
$action['save_settings']['view']  		= 'settings.php';



$controller = $action[$todo]['cont'];
$view       = $action[$todo]['view'];

if ( $controller && file_exists( $dir_controllers . $controller ) )
    require_once( $dir_controllers . $controller );

$links_line = '<a href="/">Главная</a> | <a href="index.php">Игроки</a> | ';

if ( $user_authorized )
	$links_line .= '<a href="index.php?todo=list_matches">Матчи</a> | <a href="index.php?todo=settings">Настройки</a> |';

$links_line .= '<a href="index.php?todo=exit">Выйти</a> | <br>';

if ( isset ( $no_links ) && $no_links )
	$links_line = '';

require_once( 'header.php' );

//for debugging
if ( $local_server )
    require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/dBug.php' );  

if ( isset ( $action[$todo] ) && file_exists( $dir_views . $view ) )
    $file_name = $dir_views . $view;
else 
    $file_name = $dir_views . 'wrong_action.php';
   
require_once( $file_name );

require_once( 'footer.php' );