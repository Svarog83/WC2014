<? require_once ( $_SERVER['DOCUMENT_ROOT'] .'/javascripts/prototype.php' );?>

<script language="JavaScript"src="./ajax/ajax.js"></script>

<script language="JavaScript">
<!--
function list_users( ) 
{
	document.getElementById('div_list').innerHTML = '<img src="/icon/ajax_load.gif" width="16" height="16" border="0"> Loading...';
	
	var obj_form = document.getElementById('form');
	
	JsHttpRequest.query(
	    './ajax/?todo=show_users',
	    
	    { frm:obj_form },
	
	    function ( arr, txt ) 
	    {
	        document.getElementById('div_list').innerHTML        = txt;
	
	    },
	
	    true
	
	)
}

function block_user( id ) 
{
	var obj = document.getElementById('td_state_' + id);
	
	if ( obj )
	{
		obj.innerHTML = '<img src="/icon/ajax_load.gif" width="16" height="16" border="0">';
		
		JsHttpRequest.query(
		    './ajax/?todo=block_user',
		    
		    { select_user:id },
		
		    function ( arr, txt ) 
		    {
		        obj.innerHTML        = txt;
		
		    },
		
		    true
		
		)
	}
}

//-->
</script>

<form name="form" method="POST" id="form" enctype="multipart/form-data">
<fieldset>
ID: <input type="text" name="select_user" size="20"> &nbsp;&nbsp;&nbsp; 
Login <input type="text" name="user_login" maxlength="32" size="20"> &nbsp;&nbsp;&nbsp; 

Status: <select name="user_state" onchange="self.focus();">
<option value="">Select state
<option value="a">A
<option value="b">B
</select>

&nbsp;&nbsp;&nbsp;

Role: 
<? 

$arr = array();
$arr['field_name'] = 'user_role';
$arr['onchange']   = 'self.focus()';
$arr['show_select_title'] = 'Select role';
$arr['select_values'] = $RolesArr;

echo PrepareSelect( $arr ); 
?>

&nbsp;&nbsp;&nbsp;

Supervisor: 
<? 

$arr = array();
$arr['field_name'] = 'user_svisor';
$arr['onchange']   = 'self.focus()';
$arr['show_select_title'] = 'Select supervisor';
$arr['select_values'] = $SuperVisorsArr;

echo PrepareSelect( $arr ); 
?>

<br><br>
<? DrawButton( 'Search', 'list_users();', '/icon/search.gif', '', '' ); ?>
&nbsp;&nbsp;
<? DrawButton( 'Clear', 'document.form.reset();', '/icon/exit1.gif', '', '' ); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<? DrawButton( 'Add user', "ShowWindow('./?todo=user_edit&no_links=1', 'New user', 600, 500);", '/icon/add.gif', '', '' ); ?>
</fieldset>

<br>
<br>

<div id="div_list"></div>

</form>

<script language="JavaScript">
<!--
list_users();
//-->
</script>