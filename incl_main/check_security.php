<?

session_start();

$error_message = array(); 

if ( $todo == 'exit' )
{
	if ( isset ( $_SESSION['user_id'] ) )
	{
		unset ( $_SESSION['user_id'] );
		session_destroy();
	}
	$todo = '';
}
else if ( is_array ( $_SESSION ) && count ( $_SESSION ) )
{
	if ( !isset ( $_SESSION['user_id'] ) )
		$error_message[] = 'No session';
	else if ( !isset ( $_SESSION['timeout'] ) )
		$error_message[] = 'No timeout info';
	else if ( !isset ( $_SESSION['hash'] ) )
		$error_message[] = 'No hash info';
	else if ( isset ( $_SESSION['timeout'] ) && ( $_SESSION['timeout'] + $setup_timeout ) < time() )
		$error_message[] = 'Время вышло';
	else 
	{
		/*echo '<br>user_id = ' . $_SESSION['user_id'] . '<br><br>';
		echo '<br>timeout = ' . $_SESSION['timeout'] . '<br><br>';
		echo '<br>REMOTE_ADDR = ' . $_SERVER['REMOTE_ADDR'] . '<br><br>';
		echo '<br>$setup_secret_word = ' . $setup_secret_word . '<br><br>';*/
		
		$md5 = md5 ( $_SESSION['user_id'] . $_SESSION['timeout'] . $setup_secret_word );
		
		if ( $md5 != $_SESSION['hash'] )
			$error_message[] = 'Данные изменились.';
	}
	
	if ( !count ( $error_message ) )
	{
		$user_id = (int)$_SESSION['user_id'];
		$query = "SELECT * FROM user WHERE user_id = '$user_id' && user_state = 'a'";
		$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
		
		if ( mysql_num_rows( $result ) == 1 )
		{
			$UA = mysql_fetch_array ( $result,  MYSQL_ASSOC );
			
			SetSessionData( $UA['user_id'], $setup_secret_word );
		}
		else 
			$error_message[] = 'Wrong user ID!';
	}
}
else 
	$error_message[] = 'No session found. ';


if ( count ( $error_message ) && $todo )
{
//		echo implode ( ', ', $error_message );
		//echo '<br><a href="/admin/">Нужно войти опять</a>';
		if ( isset( $_SESSION['user_id'] ) )
			mail ( "sergey@vetko.net", 'Session problems in MIFI', "error = \n" . print_r ( $error_message, TRUE ) . "\n\n" . print_r ( $_SESSION, TRUE ) . "\n\n todo = " . $todo . "\n\n UA = " . print_r ( $UA, TRUE ) );
			
		unset ( $_SESSION['user_id'] );
		session_destroy();
//		header( "Location: /");
//		exit();
}