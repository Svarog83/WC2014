<?php
$form_sett = $_REQUEST['form_sett'];

if ( is_array( $form_sett ) && count( $form_sett ) )
{
    $query = "DELETE FROM setting";
    $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
    foreach ( $form_sett AS $key => $value )
    {
        $query = "INSERT INTO setting SET sett_name = '" . mysql_real_escape_string( $key ) . "', sett_value = '" . mysql_real_escape_string( $value ) . "'";
        $result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
    }
}
$settings_arr = array( );
$query = "SELECT * FROM setting";
$result = mysql_query( $query ) or eu( __FILE__, __LINE__, $query );
while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
    $settings_arr[$row['sett_name']] = $row['sett_value'];