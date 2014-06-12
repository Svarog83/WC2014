<? $component_name = 'navigation'; include( 'include_component.php' ); ?>

<script src="http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="/javascripts/lib/jquery.hoverIntent.js" type="text/javascript"></script> <!-- optional -->
<script src="/javascripts/jquery.cluetip.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('a.tips').cluetip();
});
</script>
<link rel="stylesheet" href="/css/jquery.cluetip.css" type="text/css" />

<script language="JavaScript" type="text/javascript">
<!--
function SaveForm()
{
    var obj_check = document.getElementById( 'check_id' );
    var confirmed = true;
    if ( obj_check && obj_check.checked )
    {
        confirmed = confirm( 'Точно заблокировать ввод результатов за ' + obj_check.value + ' тур?' );
    }

    if ( confirmed )
        document.form2.submit();
}

function GetExcel()
{ 
	get_excel.location.href = '/get_excel/?ajax_flag=1';
}

//-->
</script>

<iframe name="get_excel" style="display:none;" height="100"></iframe>
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
			 <form action="/save_bets/" method="post" name="form2">
			<div class="post">
				<h1 class="title">Календарь</h1>

				<div class="entry">
				<span align="right"><input type="button" name="get_excel" value="Скачать в Excel" onClick="GetExcel();"></span>
					<table cellpadding="2" cellspacing="2" border="1" width="100%">
						<tr>
							<td>No</td>
							<td>Команда 1</td>
							<td>Команда 2</td>
							<td>Дата</td>
							<td>Результат</td>
						<? if ( $user_authorized ): ?>

							<td>Ставки</td>
						<?endif;?>
				</tr>

					<? if ( !count( $MatchesArr ) ):?>
						<tr>
							<td colspan="6">Матчей не найдено</td>
						</tr>
					<?
					else : ?>
					<? $old_tour = 0; ?>
					<? foreach ( $MatchesArr AS $row ): ?>
					<? if ( $old_tour != $row['g_tour'] ):?>
						<tr>
							<td colspan="6" style="font-weight:bold;">Тур <?php echo $row['g_tour']; ?></td>
						</tr>
					<? $old_tour = $row['g_tour']; ?>
					<? endif; ?>

					<? $i++ ?>
						<tr>
							<td><?= $i?></td>
							<td><?= $TeamsArr[$row['g_team1']]?></td>
							<td><?= $TeamsArr[$row['g_team2']]?></td>
							<td style="white-space:nowrap;"><?= $row['g_date_time']?></td>
							<td>&nbsp;<?= $row['g_result']?></td>
						<? if ( $user_authorized ): ?>
							<td style="white-space:nowrap;">
                                <input type="text" size="4" <?= $row['readonly'] ? 'readonly title="' . $row['readonly'] . '" style="background-color: #C0C0C0;"' : '' ?> name="match_result[<?= $row['g_id']?>]" value="<?= isset ( $MatchResults[$row['g_id']] ) ? $MatchResults[$row['g_id']] : '' ?>">
                                <a class="tips" href="/match_bets/<?= $row['g_id'] ?>/?ajax_flag=1" rel="/match_bets/<?= $row['g_id'] ?>/?ajax_flag=1" title="<?= $TeamsArr[$row['g_team1']] . '-' .  $TeamsArr[$row['g_team2']] ?>">?</a>
                            </td>
						<?endif;?>

						</tr>
					<? endforeach; ?>
				<? endif; ?>

					</table>
                    <br>

                    <? if ( $UA['user_last_tour'] ): ?>
                    <div style="font-weight:bold;">
                    Последний завершенный тур: <?= $UA['user_last_tour'] ?>
                     </div>
                    <? endif; ?>

                    <? if ( $user_authorized ): ?>
                        <? if ( $all_entered && $S_TOUR > $UA['user_last_tour'] ): ?>
                        <input type="checkbox" id="check_id" name="checkbox_tour" value="<?= $S_TOUR ?>">Ввод результатов для тура #<?= $S_TOUR?> завершен<br>
						<? elseif ( !$all_entered ): ?>
						<b>Не все результаты для тура № <?= $S_TOUR?> введены</b><br>
                        <? endif; ?>
                     <input type="button" value="Save" onclick="SaveForm();">
                    <?endif;?>

				</div>
			</div>

			</form>
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
