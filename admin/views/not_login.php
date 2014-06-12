<script type="text/javascript" src="/javascripts/enter.js"></script>

<script language="JavaScript">
<!--
	
function submit_form()
{
    document.form.add_pwd.value = MD5( document.form.pwd.value );
    document.form.pwd.value = '';
    document.form.submit();
}

//-->
</script>

<form action="index.php" name="form" method="POST">
<input type="hidden" name="todo" value="login">
Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="login" value="" size="30"><br>
Password: <input type="password" name="pwd" value="" size="30">

<input type="hidden" name="add_pwd" value="">
<input type="button" value="login" onclick="submit_form();">
</form>

