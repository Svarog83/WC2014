<?


$MatchResults = ( $user_authorized ? get_match_results ( $UA['user_id'] ) : array() );
$all_entered = true;
$MatchesArr  = array();

$query = "SELECT * FROM game WHERE 1 ORDER BY g_tour DESC, g_date_time, g_id";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	if ( $row['g_tour'] <= $UA['user_last_tour'] )
        $row['readonly'] = 'Ввод на этот тур уже завершен';
   else if ( $row['g_date_time'] <= $setup_today )
        $row['readonly'] = 'В день матча менять ничего нельзя!!';
   else
        $row['readonly'] = '';

	if ( $row['g_tour'] == $S_TOUR && !$MatchResults[$row['g_id']] && !$row['readonly'] )
		$all_entered = false;

    $MatchesArr[] = $row;
}

$TeamsArr = getTeams();

