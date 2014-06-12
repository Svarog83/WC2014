<fieldset>
<form name="form" method="POST" action="./?todo=user_save&no_links=true">
<input type="hidden" name="select_user" value="<?= $select_user?>">
<table width="90%" border="0" cellpadding="2" cellspacing="2">

<tr>
<td>Имя</td>
<td>
<input type="text" name="user_name" value="<?= isset ( $UserArr['user_name'] ) ? $UserArr['user_name'] : '' ?>" size="40" maxlength="32">
</td>
</tr>

<tr>
<td>Фамилия</td>
<td>
<input type="text" name="user_fam" value="<?= isset ( $UserArr['user_fam'] ) ? $UserArr['user_fam'] : '' ?>" size="40" maxlength="32">
</td>
</tr>

<tr>
<td>E-mail</td>
<td>
<input type="text" name="user_email" value="<?= isset ( $UserArr['user_email'] ) ? $UserArr['user_email'] : '' ?>" size="40" maxlength="32">
</td>
</tr>

<tr>
<td>Login</td>
<td>
<input type="text" name="user_login" value="<?= isset ( $UserArr['user_login'] ) ? $UserArr['user_login'] : '' ?>" size="40" maxlength="32">
</td>
</tr>

<tr>
<td>Status</td>
<td>
<select name="user_state" onchange="self.focus();">
<option value="a" <?= isset ( $UserArr['user_state'] ) && $UserArr['user_state'] == 'a' ? ' selected' : ''  ?>>A
<option value="b" <?= isset ( $UserArr['user_state'] ) && $UserArr['user_state'] == 'b' ? ' selected' : ''  ?>>B
</select>
</td>
</tr>

<tr>
<td>Role</td>
<td>
<? 

$arr = array();
$arr['field_name'] 		  	= 'user_role';
$arr['onchange']   		  	= 'self.focus()';
$arr['show_select_title'] 	= 0;
$arr['selected_value'] 		= isset ( $UserArr['user_role'] ) ? $UserArr['user_role']: 'user';	
$arr['select_values'] 		= $RolesArr;

echo PrepareSelect( $arr ); 
?>
</td>
</tr>

</table>

<br>
<br>
<center>
<? DrawButton( 'Save', 'document.form.submit();', '/icon/button.gif', '', '' ); ?>
&nbsp;&nbsp;
<? DrawButton( 'Close window', "parent.Windows.closeAll();", '/icon/exit1.gif', '', '' ); ?>
</center>

</form>
</fieldset>