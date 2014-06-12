<?php

$settings_arr = array();
$query = "SELECT * FROM setting";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
    $settings_arr[$row['sett_name']] = $row['sett_value'];