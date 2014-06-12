<?
$DOCUMENT_ROOT  = $_SERVER['DOCUMENT_ROOT'];
$HTTP_REFERER   = $_SERVER['HTTP_REFERER'];

if( function_exists('date_default_timezone_set') )
    date_default_timezone_set( 'Europe/Moscow' );
    
setlocale(LC_TIME, 'ru_RU.utf8');
    
if( $_SERVER['HTTP_HOST'] == 'www.bets.ru' )
{   
	$local_server		= true;
}
else
{
	$local_server = false;
}

$setup_secret_word = 'you_never_guess_it';
$setup_timeout = 86400 * 10; //10 days
$setup_cache_folder = $_SERVER['DOCUMENT_ROOT'] . '/cache/';
$setup_today = date ( "Y-m-d" );
$setup_beer_tours = 3;

define ( "FATAL",	E_USER_ERROR);
define ( "ERROR",	E_USER_WARNING);
define ( "WARNING",	E_USER_NOTICE);
define ( "PARSING",	E_ERROR);

// set the error reporting level for this script

error_reporting ( FATAL | ERROR | WARNING | PARSING );
error_reporting(E_ALL & ~E_USER_NOTICE & ~E_NOTICE );
error_reporting(4);
error_reporting ( E_ALL & ~E_NOTICE );

$admin_email		=  array(
'svaroggg@gmail.com'
);

//// Used languages in System
$LangArr = array( 

'rus'   => 'Russian',
'eng'   => 'English'

);


///////////////////////////////////////////

if( $local_server )
{
	$www_main			= 'bets.ru';
	$www_main_full		= 'http://www.bets.ru';
	$real_www			= 'http://bets.ru';
}
else
{
	$www_main			= 'bets.vetko.net';
	$www_main_full		= 'http://bets.vetko.net';
	$real_www			= 'http://bets.vetko.net';
}

////////////////////////////////////////////////////////////////////////
//  Подключение к БД

if( $local_server )
{
	$db_host_name_main	= 'localhost';
	$db_name_main		= 'bets';
	$db_user_name_main	= 'root';
	$db_password_main	= '';

}
else
{
	$db_host_name_main	= 'mysql1084.servage.net';
	$db_name_main		= 'bets_site';
	$db_user_name_main	= 'bets_site';
	$db_password_main	= 'dtnjrhtc1';
}

////////////////////////////////////////////////////////////////////////
//  Ошибка в запросе к БД ++++++++++++++++++++++++++++++++++++++++++++++

if ( !function_exists( 'eu' ) )
{
	function eu( $a, $b, $c ) 		
	{

		global $admin_flag;
		global $local_server;
		global $admin_email;
		global $UA;
		
		$admin_flag = true;


		$t =  '<span style="color:#ff0000;"><b>SQL_Error</b>:</span><br>file: <b>' .
$a .		'</b><br> line: <b>'.

		$b .
		'</b><br><b>'.

		$c .
		'</b><br>'.
		mysql_errno().
		'<br>'.
		mysql_error().
		'<br>' ;
		
		$tt = '<span style="color:red;"><hr style="color:#ff0000">Sorry, the script was stopped for the MySQL error!!<br>Please, be patient - Mail was sent to Administrators and the Error will be fixed ASAP<br>You will be informed about this<b></b><hr style="color:#ff0000"></span>';

		if( $admin_flag || $local_server )
		{
			echo $t;
	?><pre>$_POST: 
	<? print_r( $_POST  ) ?></pre><br><?
	?><pre>$_GET:  
	<? print_r( $_GET  ) ?></pre><?

		}
		else
		{

			$t_admin = '

Dear, dear Admin!!!!!!!

This is GTracker.....

Sorry for disturbance, but damned MySQL doesnt want to work good - give it a kick!

MySQL_Error----------------------------------------------

file: '. $a . '
line: '. $b .'
database: $$$DATABASE$$$
'. $c . '

'. mysql_errno(). '
'. mysql_error().'

'. $UA['user_fam_eng'] .'  '. $UA['user_name_eng'] .'
'. $UA['user_email'] .'

Vars:
POST --------------
'.

			print_r( $_POST, true )

			.'
GET ---------------
'.

			print_r( $_GET, true )

			.'
Time---------------
'.
			
			
			date( "Y-m-d, H:i:s", time() )
			
			.'
			
Referer------------
'.
			
			
			$_SERVER["HTTP_REFERER"]
			
			.'
			
Browser-----------
'.
			
			$_SERVER["HTTP_USER_AGENT"]
			
			.'

With big respects,
GTracker

';
			$r = mysql_query("SELECT DATABASE()") or die(mysql_error());
   			$ttt = mysql_result($r,0);
			
   			$t_admin = str_replace( '$$$DATABASE$$$', $ttt, $t_admin );
			
			echo $tt;
			@mail( implode( ',', $admin_email ), 'MySQL Error GTracker', $t_admin );
		}
		die;
	}
}
////////////////////////////////////////////////////////////////////////
//  Ошибка в запросе к БД ----------------------------------------------


////////////////////////////////////////////////////////////////////////
//  Ошибка в PHP +++++++++++++++++++++++++++++++++++++++++++++++++++++++

if ( !function_exists( 'gtracker_error_handler' ) )
{
	function gtracker_error_handler( $errno, $errstr, $errfile, $errline, $vars ) 		{

		if( $errno != 8 && error_reporting() )
		{
			global $UA;
			global $local_server;
			global $admin_email;
			global $admin_flag;


			$t =  '<br><span style="color:red;"><b>PHP Error</b>:</span><br>
Description: '.$errstr.'
<br>
file: <b>' . $errfile .	'</b> line: <b>'. $errline .'</b><br>';

			if( ( $admin_flag || $local_server ) )
			{
				echo $t;
			}

			$t_admin = '

Dear, dear Admin!!!!!!!

This is GTracker.....

Sorry for disturbance, but damned GTracker script doesnt want to work good - give it a kick!

PHP_Error----------------------------------------------

file: '. $errfile . '
line: '. $errline .'
error number: '. $errno .'
error description: '. $errstr .'

'. $UA['user_fam_eng'] .'  '. $UA['user_name_eng'] .'
'. $UA['user_email'] .'

Vars:
POST --------------
'.
            print_r( $_POST )

			.'
GET ---------------
'.

             print_r( $_GET )

			.'
Time---------------
'.
			
			
			date( "Y-m-d, H:i:s", time() )
			
			.'
			
Referer------------
'.
			
			
			$_SERVER["HTTP_REFERER"]
			
			.'
			
Browser-----------
'.
			
			$_SERVER["HTTP_USER_AGENT"]
			
			.'

With big respects,
GTracker

';
			@mail( implode( ',', $admin_email ), 'PHP Error GTracker', $t_admin );

		}
	}
}

set_error_handler("gtracker_error_handler" );