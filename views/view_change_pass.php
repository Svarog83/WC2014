<? $component_name = 'navigation'; include( 'include_component.php' ); ?>
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<? $component_name = 'games'; include( 'include_component.php' ); ?>
			</ul>
		</div>
		
		<!-- start content -->
		<div id="content">
			<div class="post">
			<h1 class="title">Смена пароля</h1>
				<div class="entry">
				
			<form id="searchform" method="post" action="/save_new_pass/" name="form">
				<div>
					Логин<br>
					 <input type="text" name="login" id="s" size="10" value="<?= $UA['user_login']?>" /><br>
					 
					  Старый пароль<br>
					<input type="password" name="pwd_old" id="s" size="15" value="" /><br>
					 
					 Новый Пароль<br>
					<input type="password" name="pwd" id="s" size="15" value="" /><br>
					 
					Еще раз новый пароль<br>
					<input type="password" name="pwd_2" id="s" size="15" value="" /><br>
					
					<input type="hidden" name="add_pwd" value="">
					<input type="button" value="Сменить" class="buttons" onclick="submit_pass();">
				</div>
			</form>
				
				</div>
			</div>
		</div>
		<!-- end content -->
		
		<!-- start sidebars -->
		<div id="sidebar2" class="sidebar" name="form">
			<ul>
				<? $component_name = 'login'; include( 'include_component.php' ); ?>
			</ul>
		</div>
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>

<script language="JavaScript">
<!--
function submit_pass()
{

	if ( document.form.login.value.length < 3 )
	{
		alert ( 'Не указан логин' );
		document.form.login.focus();
		return false;
	}
	
	if ( document.form.pwd_old.value.length < 1 )
	{
		alert ( 'Не указан старый пароль' );
		document.form.pwd_old.focus();
		return false;
	}
	
	if ( document.form.pwd.value.length < 1 )
	{
		alert ( 'Не указан новый пароль' );
		document.form.pwd.focus();
		return false;
	}
	
	if ( document.form.pwd.value != document.form.pwd_2.value )
	{
		alert ( 'Вы неправильно повторили пароль' );
		return false;
	}
	
	document.form.submit();
}
//-->
</script>
