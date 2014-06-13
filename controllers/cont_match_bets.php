<?

if ( !checkRights ( array ( 'user' ) ) )
    echo 'Нет прав. Надо сначала залогиниться';

$select_game = (int)$GLOBAL_PARAMS[1];

$query = "SELECT * FROM game WHERE g_id = '$select_game' ";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
$GA = mysql_fetch_array( $result, MYSQL_ASSOC );

if ( !$GA )
{
   echo 'Матч не найден';
   exit();
}

/*if ( $GA['g_tour'] > $UA['user_last_tour'] )
{
    echo 'Надо сначала завершить ввод результатов за тур ' . $GA['g_tour'];
    exit();
}*/

$ResultsArr = array();
$query = "
    SELECT
user_name,
user_fam,
mr_result,
user_last_tour,
g_tour,
g_date_time
    FROM
match_result,
user,
game
    WHERE
mr_game = '$select_game' &&
g_id = mr_game &&
mr_user = user_id &&
mr_activ = 'a' &&
user_id != '{$UA['user_id']}'
    ORDER BY
user_name
";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
{
	/*echo '<br>$today=' . $setup_today . '<br>';
	echo '<br>$game_date=' . $row['g_date_time'] . '<br>';
	echo '<br>$game_tour=' . $GA['g_tour'] . '<br>';
	echo '<br>$user_tour=' . $UA['user_last_tour'] . '<br>';*/

	if ( $setup_today >= $row['g_date_time'] || $GA['g_tour'] <= $UA['user_last_tour'] )
        $ResultsArr[] = $row;
	else if ( $GA['g_tour'] > $UA['user_last_tour'] )
	{
		echo 'Нельзя смотреть будущие чужие ставки.<br>Надо сначала завершить ввод результатов за тур ' . $GA['g_tour'];
		exit();
	}
	else if ( $setup_today < $row['g_date_time'] )
	{
		echo 'Можно смотреть ставки других только за текущую дату';
		exit();
	}

}


