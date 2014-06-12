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

if ( $GA['g_tour'] > $UA['user_last_tour'] )
{
    echo 'Надо сначала завершить ввод результатов за тур ' . $GA['g_tour'];
    exit();
}

$ResultsArr = array();
$query = "
    SELECT
user_name,
user_fam,
mr_result,
user_last_tour,
g_tour
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
    $ResultsArr[] = $row;


