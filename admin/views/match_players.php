<fieldset>
<form name="form" method="POST" action="./?todo=email_send&no_links=true">
<input type="hidden" name="select_game" value="<?= $select_game?>">

<div class="head>">
Матч против <b><?= getTeamName( $MatchArr['g_team1'] )?></b>, который состоится <b><?= $MatchArr['g_date_time']?></b>:
</div>
<br>
<table width="90%" border="1" cellpadding="2" cellspacing="2">
<tr colspan="4"><b>БУДУТ</b></tr>
<tr>
<td>No</td>
<td>Имя</td>
<td>Фамилия</td>
<td>E-mail</td>
<td>Комментарии</td>
<td>&nbsp;</td>
</tr>
<? foreach ( $PlayersArr['good'] AS $row ): ?>
<tr style="font-weight:bold;">
<td><?= ++$i?></td>
<td><?= $row['user_name']?></td>
<td><?= $row['user_fam']?></td>
<td><?= $row['user_email']?></td>
<td>&nbsp;<?= $row['gul_remarks']?></td>
<td align="center"><img src="/icon/exit.gif" title="Человека не будет" style="cursor:pointer;" onclick="location.href='./?todo=match_players&select_game=<?= $select_game?>&select_user=<?= $row['user_id']?>&status=0&no_links=1';"></td>
</tr>
<? endforeach;?>
<? $i = 0; ?>
</table>

<br>
<table width="90%" border="1" cellpadding="2" cellspacing="2">
<tr colspan="4"><b>НЕ БУДУТ</b></tr>
<tr>
<td>No</td>
<td>Имя</td>
<td>Фамилия</td>
<td>E-mail</td>
<td>Подтвердил?</td>
<td>Комментарии</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<? foreach ( $PlayersArr['bad'] AS $row ): ?>
<tr style="font-weight:bold;">
<td><?= ++$i?></td>
<td><?= $row['user_name']?></td>
<td><?= $row['user_fam']?></td>
<td><?= $row['user_email']?></td>
<td><?= $row['gul_id'] ? 'Да' : 'Нет'?></td>
<td>&nbsp;<?= $row['gul_remarks']?></td>
<td align="center"><img src="/icon/button.gif" title="Человек будет" style="cursor:pointer;" onclick="location.href='./?todo=match_players&select_game=<?= $select_game?>&select_user=<?= $row['user_id']?>&status=1&no_links=1';"></td>
<td><input type="checkbox" name="check_user[]" value="<?= $row['user_id'] ?>" <?= !isset ( $EmailsArr[$row['user_id']] ) && $row['user_email'] ? ' checked' : '' ?> title="Отправить письмо"></td>
</tr>
<? endforeach;?>
</table>
(прим: если чекбокс отмечен, значит письмо еще не отправлялось пользователю. Если снят, значит уже отправляли. Письмо будет отправлено только тем, у кого отмечен чекбокс!)
<br>
<br>

<b>Комментарии в письмо:</b><br>
<textarea name="form_message" rows="7" cols="50"></textarea>
<br>
<br>

<center>
<? DrawButton( 'Отправить письма', 'form_submit();', '/icon/mail2.gif', '', '' ); ?>
&nbsp;&nbsp;
<? DrawButton( 'Закрыть окно', "parent.Windows.closeAll();", '/icon/exit1.gif', '', '' ); ?>
</center>

</form>
</fieldset>

<script language="JavaScript">
<!--
function form_submit()
{
	document.form.submit();	
}
//-->
</script>