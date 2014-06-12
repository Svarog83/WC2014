<?
if ( $component_name )
{
	if ( file_exists( "./components/comp_$component_name.php" ) )
		include_once( "./components/comp_$component_name.php" );
		
	if ( file_exists( "./templates/temp_$component_name.php" ) )
		include_once( "./templates/temp_$component_name.php" );
		
	unset ( $component_name );
}
			