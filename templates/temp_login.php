<? $component_name = 'news'; include( 'include_component.php' ); ?>
<br>
<li>
	<? if ( !$user_authorized ): ?>
	
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
	
	<form id="searchform" method="post" action="/login/" name="form">
		<div>
			<h2>Войти</h2>
			Логин<br>
			 <input type="text" name="login" id="s" size="10" value="" /><br>
			 Пароль<br>
			<input type="password" name="pwd" id="s" size="15" value="" /><br>
			<input type="hidden" name="add_pwd" value="">
			<input type="button" value="Войти" class="buttons" onclick="submit_form();">
		</div>
	</form>
	<? else : ?>
	<h2>Настройки</h2>
	<ul>
		<li><a href="/change_pass/">Сменить пароль</a>
	</ul>
	<input type="button" value="Выйти" class="buttons" onclick="location.href='/exit/'">
	<? endif;?>
</li>
<br>
