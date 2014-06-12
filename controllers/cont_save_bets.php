<?php
if ( !$user_authorized ) redirect( '/no_admission/' );

$HackAttempts = array();

$MatchResults = get_match_results( $UA['user_id'] );
$MatchesArr = get_matches();

$match_result = $_REQUEST['match_result'];

$checkbox_tour = ( isset ( $checkbox_tour ) ? (int)$checkbox_tour : '' );

if ( $checkbox_tour && $checkbox_tour > $S_TOUR )
    $HackAttempts[] = array ( 'type' => 'Bigger than possible S_TOUR', 'content' => 'none' );

if ( $checkbox_tour && $checkbox_tour < $UA['user_last_tour'] )
    $HackAttempts[] = array ( 'type' => 'Less than user_last_tour', 'content' => 'none' );

if ( $checkbox_tour && $checkbox_tour <= $S_TOUR && $checkbox_tour > $UA['user_last_tour'] )
{
    $query = "UPDATE user SET user_last_tour = '$checkbox_tour' WHERE user_id = '{$UA['user_id']}'";
    $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}

if ( is_array ( $match_result ) && count ( $match_result ) )
{
	$UpdatedIds = $query_arr = array();
	foreach ( $match_result AS $g_id => $result )
	{
		$result = str_replace ( ':', '-', trim ( $result ) );

		if ( $result && preg_match ( "/[0-9]{1,2}-[0-9]{1,2}/", $result ) && ( !isset ( $MatchResults[$g_id] ) || $result != $MatchResults[$g_id] ) )
		{
			if ( $MatchesArr[$g_id]['g_tour'] <= $UA['user_last_tour'] )
            {
                $HackAttempts[] = array ( 'type' => 'Tried to change results for old tours', 'content' => 'MATCH = ' . print_r ( $MatchesArr[$g_id], TRUE ) );
            }
            else if ( $MatchesArr[$g_id]['g_date_time'] <= $setup_today )
            {
                $HackAttempts[] = array ( 'type' => 'Tried to change results for old dated match', 'content' => 'MATCH = ' . print_r ( $MatchesArr[$g_id], TRUE ) );
            }
            else
            {
                $UpdatedIds[] = $g_id;

                $query_arr[] = "
                    INSERT INTO
                match_result
                    SET
                mr_activ 	= 'a',
                mr_game 	= '" . (int) $g_id . "',
                mr_user 	= '" . (int) $UA['user_id'] . "',
                mr_result 	= '" . mysql_real_escape_string( $result ) . "',
                mr_change_time = '" . date ( "Y-m-d H:i:s" ) . "'
                ";
            }
		}
	}

	if ( count ( $UpdatedIds ) )
	{
		$query = "UPDATE match_result SET mr_activ = 'ch', mr_change_time = '" . date ( "Y-m-d H:i:s" ) . "' WHERE mr_user = '" . $UA['user_id'] . "' && mr_game IN ('" . implode( "', '", $UpdatedIds ) . "')";
		$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
	}

	foreach ( $query_arr AS $query )
		$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
}

if ( count ( $HackAttempts ) )
{
    mail ( 'sergey@vetko.net', 'Hacks in save bets!', print_r ( $HackAttempts, TRUE ) . "\n\nUA=" . print_r ( $UA, true ) . "\n\nREQUEST = " . print_r ( $_REQUEST, TRUE) . "\n\nS_TOUR = " . $S_TOUR . "\n\nCheckbox = " . $checkbox_tour . "\n\nsetup_today = " . $setup_today );
}

redirect( "/calendar/");