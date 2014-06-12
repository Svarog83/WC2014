<? if ( $error_message ): ?>
<div class="warn"><?= $error_message ?></div>
<br>
<center>
<? DrawButton( 'Back', 'history.back();', '/icon/left.gif', '', '' ); ?>
&nbsp;&nbsp;
</center>

<? else : ?>
<script language="JavaScript">
<!--
parent.list_users();
parent.Windows.closeAll();	
//-->
</script>
<? endif; ?>