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
parent.list_matches();
parent.Windows.closeAll();	
//-->
</script>
<? endif; ?>