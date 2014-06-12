<?
require_once( 'ajax.php' ); 
$JsHttpRequest =& new JsHttpRequest( 'UTF-8' );

$flag_ajax_action   = 
$flag_ajax_output	= TRUE;

require_once ( '../../incl_main/config_main.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/incl_main/check_security.php' );

//require_once ( '../../incl_main/check_oms.php' );
//require_once ( '../../functions/function_all.php' );

header('Content-Type:text/html; charset=UTF-8'); 

$dir_views = '../views/';
$dir_controllers = '../controllers/';

$controller = 'ajax_' . $todo . '.php';
$view 		= 'ajax_' . $todo.  '.php';

if ( $controller && file_exists( $dir_controllers . $view ) )
    require_once( $dir_controllers . $controller );
    
if ( isset ( $view ) && file_exists( $dir_views . $view ) )
	require_once( $dir_views . $view );  
//$file_name = $dir_views . $view;
/*else 
    $file_name = $dir_views . 'wrong_action.php';*/
    
//require_once( $file_name );
