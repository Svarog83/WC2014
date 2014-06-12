<?
$RolesArr  = getRoles();

$SuperVisorsArr  = array();
$query = "SELECT user_id, user_login FROM user WHERE user_role = 'svisor' ORDER BY user_login";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
    $SuperVisorsArr[$row['user_id']] = $row['user_login'];
    
    