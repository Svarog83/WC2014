<? require_once ( $_SERVER['DOCUMENT_ROOT'] .'/javascripts/prototype.php' );?>

<script language="JavaScript"src="./ajax/ajax.js"></script>

<script language="JavaScript">
<!--
function list_matches( ) 
{
	document.getElementById('div_list').innerHTML = '<img src="/icon/ajax_load.gif" width="16" height="16" border="0"> Loading...';
	
	var obj_form = document.getElementById('form');
	
	JsHttpRequest.query(
	    './ajax/?todo=show_matches',
	    
	    { frm:obj_form },
	
	    function ( arr, txt ) 
	    {
	        document.getElementById('div_list').innerHTML        = txt;
	
	    },
	
	    true
	
	)
}

//-->
</script>

<form name="form" method="POST" id="form" enctype="multipart/form-data">
<fieldset>

Тур:
<?

$arr = array();
$arr['field_name'] = 'select_tour';
$arr['onchange']   = 'self.focus()';
$arr['show_select_title'] = 'Select tour';
$arr['select_values'] = $arr_tours;

echo PrepareSelect( $arr );
    ?>
   &nbsp;&nbsp;
Команда: 
<? 

$arr = array();
$arr['field_name'] = 'select_team';
$arr['onchange']   = 'self.focus()';
$arr['show_select_title'] = 'Select team';
$arr['select_values'] = $TeamsArr;

echo PrepareSelect( $arr ); 
?>

<br><br>
<? DrawButton( 'Search', 'list_matches();', '/icon/search.gif', '', '' ); ?>
&nbsp;&nbsp;
<? DrawButton( 'Clear', 'document.form.reset();', '/icon/exit1.gif', '', '' ); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<? DrawButton( 'Add match', "ShowWindow('./?todo=match_edit&no_links=1', 'New match', 600, 500);", '/icon/add.gif', '', '' ); ?>
</fieldset>

<br>
<br>

<div id="div_list"></div>

</form>

<script language="JavaScript">
<!--
list_matches();
//-->
</script>