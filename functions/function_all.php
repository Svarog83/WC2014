<?
/**
 * Cleans text
 *
 * @param string $text - text whiche needs to be cleaned
 * @param int $rep_quot - if necessary to change quotes
 * @param int $rep_new_line - if necessary to change new lines
 * @return string
 */

function CleanText( $text, $rep_quot = 1, $rep_new_line = 1 )
{
	$text	= str_replace( "\\", "", $text );
	
	if ( $rep_quot )
		$text = htmlspecialchars( $text, ENT_QUOTES );
		
	if ( $rep_new_line )
		$text = str_replace( "\n", "<br>", str_replace ( "\r", "", $text ) );
		
	$text = str_replace( array( '&lt;', '&gt;', '&amp;' ), array( '<', '>', '&' ), $text );
		
	return $text;
}

/**
 * Explodes string by :: and removes :
 *
 * @param string $str
 * @return array
 */
function GetArrFromColonString ( $str )
{
	$arr = array();
	if ( $str )
		$arr = explode ( '::', trim( $str, ':' ) );
		
	return $arr;
}

/**
 * Prepares array for inserting to DB by imploding by ::
 *
 * @param array $arr
 * @return string
 */
function FromArrToColonString ( $arr )
{
	$str = '';
	if ( is_array ( $arr ) )
		if ( count ( $arr ) )
			$str = ':' . implode ( '::', $arr ) . ':';
		
	return $str;
}

/**
 * Returns str for DB query like 
 *         " ( name LIKE ('%:1:%') || name LIKE ('%:2:%')  || name LIKE ('%:3:%')) "
 *
 * @param string $f - name of field in DB table
 *
 */

function depsUserLike ( $f ) {

global $DepUA;

$a = " ( ". $f ." LIKE '%:". implode( ":%' || ". $f ." LIKE '%:", $DepUA ) .":%' )";
return $a;


}
/**
 * Receives array and prepares select tag
 *
 * @param array $arr
 * @return string
 */

function PrepareSelect( $arr )
{
	$select_1 = '<select name="'. ( $arr['field_name'] ) .'"  '.  
				( $arr['multiple']	? ' multiple size="' . $arr['size'] . '"' : '' ) .
				( $arr['onchange']	? ' onChange="' . $arr['onchange'] . '"' : '' ) . 
				( $arr['onfocus']	? ' onFocus="' . $arr['onfocus'] . '"' : '' ) . 
				( $arr['onblur']	? ' onBlur="' . $arr['onblur'] . '"' : '' ) . 
				( $arr['add_str']	?  $arr['add_str']  : '' ) .'>';
	
				if ( $arr['show_select_title'] ) 
				    $select_1 .= '<option value="">'. ( $arr['show_select_title'] );
				
				foreach ( $arr['select_values'] AS $key => $val )
					$select_1 .= '<option value="' . ( $key ) . '" ' . ( $key == $arr['selected_value'] && isset( $arr['selected_value'] ) ? ' selected' : '' ) .
					( $key == 'empty' || strpos( $key, 'sub_' ) !== false ? ' style="background-color: '. ( $key == 'empty' ? $bg_select_empty : 'pink' ) .';"' : '' ) .
					'>' . ( $val ) . '';
				
				$select_1 .= '</select>';
				
				return $select_1;
}

function flip_vars( $a )
{
	$trans = array ( "&lt;" => "<", "&gt;" => ">", "&amp;" => "&", "&#039;" => "'", "&quot;" => '"', "<br>" => "\n", "</br>\n" => "\n", "</br>" => "\n", "\n<br>" => "\n" );

	$a = strtr($a,$trans);

	return $a;
}


function check_vars( $a )
{
	$trans = array ( "<" => "&lt;", ">" => "&gt;", '&amp;' => "&", '"' => "&quot;",  "'" => "&#039;", "\n" => "<br>", "\r" => "" );

	$a = strtr($a,$trans);

	return $a;

}

function post_var_edit_final( $data = '', $replace_slash = 0 )
{
	if( !$data )
	{
		$data	    = $_REQUEST;
		$first_iter = TRUE;
	}
	else
		$first_iter = FALSE;
	foreach( $data as $k => $v )
	{
		
		
		if( $first_iter )
			global $$k ;

		if( is_array( $v ) && !$first_iter)
			$data[$k]	= post_var_edit_final( $v, $replace_slash );
		elseif( is_array( $v ) && $first_iter )
			$$k	= post_var_edit_final( $v, $replace_slash );
		elseif( !is_array( $v ) && !$first_iter)
		{
			$v	= check_vars( stripcslashes( $v ) );
			$v	= str_replace ( "&lt;br&gt;", "<br>", $v );
			
			$data[$k]	= str_replace( "\n", "", $v );
			/*if ( $replace_slash )
				$data[$k]	= str_replace( "\\", "\\\\", $v );*/
		}
		elseif( !is_array( $v ) && $first_iter )
		{
			$v	= check_vars( stripcslashes( $v ) );
			$v	= str_replace ( "&lt;br&gt;", "<br>", $v );
			
			$$k	= str_replace( "\n", "", $v );
			/*if ( $replace_slash )
				$$k	= str_replace( "\\", "\\\\", $v );*/
		}

	}
	if ( !$first_iter )
		return $data;
}

function flip_vars_small( $a )
{
	$trans = array ( "&nbsp;" => " ", "&lt;" => "<", "&gt;" => ">", "&amp;" => "&", "&#039;" => "'", "&quot;" => '"' );

	$a = strtr($a,$trans);

	return $a;
}

function SetSessionData( $user_id, $setup_secret_word )
{
	$_SESSION['user_id'] = $user_id;
	$_SESSION['timeout'] = time();
	$_SESSION['ip'] 	 = $_SERVER['REMOTE_ADDR'];
	$_SESSION['hash'] 	 = md5 ( $user_id . $_SESSION['timeout'] . $setup_secret_word );
	
	global $user_authorized;
	$user_authorized = true;
	
	return true;
	
	/*echo '<br>user_id = ' . $user_id . '<br><br>';
	echo '<br>timeout = ' . $_SESSION['timeout'] . '<br><br>';
	echo '<br>REMOTE_ADDR = ' . $_SERVER['REMOTE_ADDR'] . '<br><br>';
	echo '<br>$setup_secret_word = ' . $setup_secret_word . '<br><br>';*/
	
}

/**
 * Draws a button (needs to include /OMSMain/incl/css_forms_buttons.php before using this function)
 *
 * @param string	$caption        Value
 * @param string	$onClick        Onclick
 * @param string	$img            path to img(/icon/button.gif)
 * @param mixed		$type           type = FALSE/0 for background buttons, type = TRUE/1 for fieldset buttons
 * @param string	$title          Title
 * @param mixed		$is_submit      type = FALSE/0 for submit buttons, type = TRUE/1 for simple buttons
 * @param string	$add_string     additional code that can be added into the <input> tag
 * @param string	$button_id      id of buttons for any actions with buttons
 * @param string	$button_dis     TRUE/1 - button disabled, FALSE/0 - otherwards
 */

function DrawButton(
$caption,
$onClick,
$img		= '/icon/button.gif',
$type		= FALSE,
$title		= '',
$is_submit	= FALSE,
$add_string = '',
$button_id	= '',
$button_dis	= ''
)

{
	global $color_body_hlt, $bg_fset;
    $caption  = str_replace( '&nbsp;', '', trim( $caption ));

    $limit  = 30;
    $len    = strlen( $caption );

    if( $len < $limit )
    {
        if( $len < 13 )
            $limit = 18;

        $tmp        = ceil( ( $limit - $len )/2 );
        $caption    = str_repeat( ' ', $tmp ) . $caption . str_repeat( ' ', $tmp ) ;
    }

?>
		<input class="button_on" type="<?= $is_submit ? 'submit' : 'button' ?>" <?= $add_string ?>
		value="<?= $caption ?>"<?= $button_id ? ' id="'. $button_id .'"' : '' ?><?= $button_dis ? ' disabled' : '' ?><?= $title ? ' title="'. $title .'"' : '' ?> style="cursor:pointer; background-image: url(<?= $img ?>); background-position: 2 center; padding-left: 20px; height: 26px; border-width: 1px;" onmouseover="this.style.color='red'"; onmouseout="this.style.color='black';" 
		<?= $onClick ? 'onClick="'. $onClick .'"' : '' ?>>

<?

}

function getRoles()
{
	$RolesArr  = array();
	$query = "SELECT * FROM role ORDER BY role_name";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
	    $RolesArr[$row['role_name']] = $row['role_name'];
	    
	return $RolesArr;
}

function getTeams()
{
	$TeamsArr  = array();
	$query = "SELECT t_id, t_name FROM team WHERE 1 ORDER BY t_name";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
	    $TeamsArr[$row['t_id']] = $row['t_name'];
	   
	return $TeamsArr;
}

function getTeamName( $team_id )
{
	global $TeamNameCache;
	$team_id = (int)$team_id;
	if ( !isset ( $TeamNameCache[$team_id] ) )
	{
		$query = "SELECT t_id, t_name FROM team WHERE t_id = '$team_id'";
		$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
		$row = mysql_fetch_array ( $result, MYSQL_ASSOC );

		$TeamNameCache[$team_id] = $row;
	}
	else
		$row = $TeamNameCache[$team_id];
	   
	return $row['t_name'];
}

function redirect ( $URL = '/' )
{
	 header( "Location: $URL");
}

function checkRights ( $options )   
{
    global $UA;
	$return_val = false;
    
    if ( isset ( $UA['user_role'] ) && $UA['user_role']  == 'adm' )
    {
    	$return_val = true;
    }
	
    else if ( isset ( $UA['user_role'] ) )
    {
	    if ( is_array( $options ) )
	        foreach ( $options as $level ) 
	        {
	            if ( $return_val = ( trim ( $level ) == $UA['user_role'] ? true : false ) )
	                break;
	        }
    }

    return  $return_val;

}

function MatchTime( $date )
{
	$return_val = 'n/a';
	$time = strtotime( $date );
	if ( $time )
	{
		$return_val = strftime("%B, %d (%A) в %H:%M", $time );
	}
	
	return $return_val;
}

function cache_exists ( $file_name )
{
	global $setup_cache_folder, $setup_cache_reset;
	return ( $setup_cache_reset ? false : file_exists( $setup_cache_folder . $file_name ) );
}

function get_cache ( $file_name )
{
	global $setup_cache_folder;
	return file_get_contents( $setup_cache_folder . $file_name );
}

function start_cache ()
{
	ob_start();
	return true;
}

function end_cache( $file_name )
{
	global $setup_cache_folder;
	$cache_html = ob_get_contents();
	ob_end_flush();
	
	if ( !is_dir( $setup_cache_folder . $file_name ) )
	{
		$file = fopen( $setup_cache_folder . $file_name , "w" );
		fwrite( $file, $cache_html );
		fclose( $file );
	}
	
	return true;
}
/**
 * @param  $real_result - real result
 * @param  $forecast - forecase of result by
 * @return int - number of points
 */
function CalculatePoints( $real_result, $forecast )
{
	global $result_sum;
	global $diff_score_sum;
	global $ishod_sum;
    /*$real_result = explode( '-' , $real_result ) ;
    $forecast = explode( '-' , $forecast ) ;
    if( $real_result[0] > $real_result[1] && $forecast[0] > $forecast[1] ||
        $real_result[0] == $real_result[1] && $forecast[0] == $forecast[1] ||
        $real_result[0] < $real_result[1] && $forecast[0] < $forecast[1] )
            $points = 2 ;
    if( $real_result[0] == $forecast[0] )
            $points += 1 ;
    if( $real_result[1] == $forecast[1] )
            $points += 1 ;
    if( ( $real_result[0] - $real_result[1] ) == ( $forecast[0] - $forecast[1] ) )
            $points += 1 ;*/

	$points = ( $forecast == $real_result ? $result_sum : ( DiffScore( $forecast ) == DiffScore( $real_result ) ? $diff_score_sum : ( sign2( DiffScore( $forecast ) ) == sign2( DiffScore( $real_result ) ) ? $ishod_sum : 0 ) ) );

    return $points;
}

function DiffScore( $val )
{
	$arr = explode ( '-', $val );

	$diff = $arr[0] - $arr[1];

	return $diff;
}

function sign2($a)
{
	if( $a>0 ) return 1;
	else if ( $a < 0 ) return -1;
	else return 2;
}

function get_match_results ( $user_id )
{
	$MatchResults = array();
	$query = "
		SELECT
	mr_game, mr_result
		FROM
	match_result
		WHERE
	mr_user = '" . (int)$user_id . "' &&
	mr_activ = 'a'
	";
	$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
	{
		$MatchResults[$row['mr_game']] = $row['mr_result'];
	}

	return $MatchResults;
}

function get_matches()
{
    $MatchesArr = array();
    $query = "SELECT * FROM game WHERE 1";
    $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
        $MatchesArr[$row['g_id']] = $row;

    return $MatchesArr;    
}

function win2utf( $s )    {
   for($i=0, $m=strlen($s); $i<$m; $i++)    {
       $c=ord($s[$i]);
       if ($c<=127) {$t.=chr($c); continue; }
       if ($c>=192 && $c<=207)    {$t.=chr(208).chr($c-48); continue; }
       if ($c>=208 && $c<=239) {$t.=chr(208).chr($c-48); continue; }
       if ($c>=240 && $c<=255) {$t.=chr(209).chr($c-112); continue; }
       if ($c==184) { $t.=chr(209).chr(209); continue; };
            if ($c==168) { $t.=chr(208).chr(129);  continue; };
            if ($c==184) { $t.=chr(209).chr(145); continue; }; #ё
            if ($c==168) { $t.=chr(208).chr(129); continue; }; #Ё
            if ($c==179) { $t.=chr(209).chr(150); continue; }; #і
            if ($c==178) { $t.=chr(208).chr(134); continue; }; #І
            if ($c==191) { $t.=chr(209).chr(151); continue; }; #ї
            if ($c==175) { $t.=chr(208).chr(135); continue; }; #ї
            if ($c==186) { $t.=chr(209).chr(148); continue; }; #є
            if ($c==170) { $t.=chr(208).chr(132); continue; }; #Є
            if ($c==180) { $t.=chr(210).chr(145); continue; }; #ґ
            if ($c==165) { $t.=chr(210).chr(144); continue; }; #Ґ
            if ($c==184) { $t.=chr(209).chr(145); continue; }; #Ґ            
   }
   return $t;
}

function ShortDate ( $date )
{
    return substr ( $date, 0, 10 );
}