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
				<h1 class="title">Отметиться</h1>
				<div class="entry">
				<? if ( count ( $error_message ) ): ?>
				<?= implode ( '<br>', $error_message ); ?>
				<? else: ?>
				Игра с командой <b>"<?= getTeamName( $GA['g_team1']) ?>"</b>.<br>
			    Начало: <b><?= MatchTime( $GA['g_date_time'] ) ?></b>
			    
			    <? if ( $GA['g_remarks'] ): ?>
			    <br>Комментарий:
			    <i style="color:red;"><?= $GA['g_remarks'] ?></i>
			    <br>

			    <? endif; ?>
			    
				<br>

				<form id="searchform" method="post" action="/save_check_game/" name="form">
				<input type="hidden" name="select_game" value="<?= $select_game?>">
				<div>
					<b>Буду на игре?</b><br>
					 <input type="radio" name="form_go" value="1" <?= isset( $MA['gul_go'] ) && $MA['gul_go'] ? ' checked' : ''?> /> Да<br>
					 <input type="radio" name="form_go" value="0" <?= isset( $MA['gul_go'] ) && !$MA['gul_go'] ? ' checked' : ''?> /> Нет<br>
					 
					  Комментарии<br>
					<input type="text" name="form_remarks" size="60" value="<?= $MA['gul_remarks']?>" /><br>
					 
					<input type="button" value="Отметиться" class="buttons" onclick="submit_form();">
				</div>
				</form>
				
				<br>
				
				<table width="90%" border="1" cellpadding="2" cellspacing="2">
				<tr colspan="4"><b>Будут на игре:</b></tr>
				<tr>
				<td>No</td>
				<td>Имя</td>
				<td>Фамилия</td>
				<td>Комментарии</td>
				</tr>
				<? foreach ( $PlayersArr['good'] AS $row ): ?>
					<tr style="font-weight:bold;">
					<td><?= ++$i?></td>
					<td><?= $row['user_name']?></td>
					<td><?= $row['user_fam']?></td>
					<td>&nbsp;<?= $row['gul_remarks']?></td>
					</tr>
				<? endforeach;?>
				<? $i = 0; ?>
				</table>
				
				<? $i = 0; ?>
				<br>
				<table width="90%" border="1" cellpadding="2" cellspacing="2">
				<tr colspan="4"><b>Не смогут:</b></tr>
				<tr>
				<td>No</td>
				<td>Имя</td>
				<td>Фамилия</td>
				<td>Комментарии</td>
				</tr>
				<? foreach ( $PlayersArr['bad'] AS $row ): ?>
					<tr style="font-weight:bold;">
					<td><?= ++$i?></td>
					<td><?= $row['user_name']?></td>
					<td><?= $row['user_fam']?></td>
					<td>&nbsp;<?= $row['gul_remarks']?></td>
					</tr>
				<? endforeach;?>
				<? $i = 0; ?>
				</table>
				
				<? endif;?>
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
function submit_form()
{
	var checked = 0;
	var obj = document.form.form_go;
	
	for ( var i = 0; i < obj.length; i++ )
	{
		if ( obj[i].checked )
		{
			checked = true;
			break;
		}
	}
	
	if ( !checked )
	{
		alert ( 'Надо выбрать хоть один пункт' );
		return false;
	}
	
	document.form.submit();
}
//-->
</script>