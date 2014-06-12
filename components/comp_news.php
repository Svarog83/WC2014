<?

$cNewsArr = array();
$query = "SELECT * FROM news ORDER BY news_date DESC LIMIT 5";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) )
	$cNewsArr[] = $row;