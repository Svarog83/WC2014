<?
if ( isset ( $to_excel ) && !checkRights ( array ( 'user' ) ) ) redirect( '/no_admission/' );

//TODO Кеширование. Хранить сумму очков по турам, каждый раз не считать.
$TeamsArr = getTeams();

$PlayersArr = array();
$query = "SELECT user_id, user_name, user_fam, user_last_tour FROM user WHERE user_state = 'a' ORDER BY user_name";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
	$PlayersArr[$row['user_id']] = array ( 'name' => $row['user_name'], 'tour' => $row['user_last_tour'] );

$colspan = 3 + count ( $PlayersArr );

$MatchesArr = array();
if ( !isset ( $to_excel ) )
	$query = "SELECT * FROM game WHERE g_result != '' ORDER BY g_tour, g_date_time, g_id";
else
	$query = "SELECT * FROM game WHERE g_result != '' OR g_date_time <= '$setup_today' ORDER BY g_tour, g_date_time, g_id";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );

$arr_t = $AllTours = array();
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	$MatchesArr[$row['g_tour']][$row['g_id']] = $row;
    $AllTours[$row['g_id']] = $row['g_tour'];
	$arr_t[] = $row['g_id'];
}

$sum_tour = $sum_total = $sum_for_beer = array();
$i = 1;
$UserResults = $ResultsArr = array();
$query = "
	SELECT
mr_game,
mr_user,
mr_result
    FROM
match_result
    WHERE
mr_game IN ( '" . implode( "', '", $arr_t ) . "' ) &&
mr_activ = 'a'
	ORDER BY
mr_game ASC
";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	if ( isset ( $PlayersArr[$row['mr_user']] ) )
	{
		$UserResults[$row['mr_game']]['users'][$row['mr_user']] = $row['mr_result'];
		$UserResults[$row['mr_game']]['mr_result'] = $row['mr_result'];
	}
}


foreach ( $UserResults AS $game_id => $v )
{
	$g_tour 		= $AllTours[$game_id];
    $real_result	= $MatchesArr[$g_tour][$game_id]['g_result'];

	$count_users = count ( $PlayersArr ) - 1;
	foreach ( $PlayersArr AS $user_id => $v2  )
	{
//		echo '<br>$user_id=' . $user_id . '<br>';
		$own_result = '';
		$total_points = 0;

		foreach ( $v['users'] AS $opponent_id => $opponent_result )
		{
			$points = $real_result && $opponent_result ? CalculatePoints( $real_result, $opponent_result ) : 0;
			/*echo '<br>$opp_id=' . $opponent_id . '<br>';
			echo '<br>$points=' . $points . '<br>';
			echo '<br>$opp_result =' . $opponent_result . '<br>';*/
			if ( $user_id == $opponent_id )
			{
				$own_result = $opponent_result;
				$total_points += $points * $count_users;
			}
			else
				$total_points -= $points;
		}

		/*echo '<br>$=' . $total_points . '<br>';
		exit();*/


		if ( !isset ( $sum_tour[$g_tour][$user_id] ) )
			$sum_tour[$g_tour][$user_id] = 0;

		if ( !isset ( $sum_total[$user_id] ) )
			$sum_total[$user_id] = 0;

		$sum_tour[$g_tour][$user_id] += $total_points;
		$sum_total[$user_id] += $total_points;

		$ResultsArr[$game_id][$user_id] = array (
								'result' => $own_result,
								'game' => $game_id,
								'points' => $total_points );
	}
}