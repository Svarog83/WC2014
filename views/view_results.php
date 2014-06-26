<? $component_name = 'navigation'; include( 'include_component.php' ); ?>
<? $i = 0; ?>
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
				<h1 class="title">Результаты</h1>

				<div class="entry">
				
					<table cellpadding="2" cellspacing="2" border="1" width="100%">
						<tr>
							<td>No</td>
							<td>Игра</td>
							<td>Результат</td>
							<? foreach ( $PlayersArr AS $user_id => $v ): ?>
								<td><?= $v['name']?></td>
							<? endforeach; ?>
						</tr>

					<? if ( !count( $MatchesArr ) ):?>
						<tr>
							<td colspan="<?= $colspan?>">Матчей не найдено</td>
						</tr>
					<? else : ?>
					<? foreach ( $MatchesArr AS $g_tour =>$v ): ?>
                        <tr>
                            <td colspan="<?= $colspan?>" style="font-weight:bold;">Тур <?php echo $g_tour; ?></td>
                        </tr>
					    <? foreach ( $v AS $g_id => $row ): ?>
                        <? $i++ ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $TeamsArr[$row['g_team1']] . '-' . $TeamsArr[$row['g_team2']] ?></td>
                                <td>&nbsp;<?= $row['g_result']?></td>
                                <? foreach ( $PlayersArr AS $user_id => $v ): ?>
                                <td style="white-space:nowrap;"><?= isset ( $ResultsArr[$g_id][$user_id] ) ? '<b>' . $ResultsArr[$g_id][$user_id]['points'] . '</b>' . ' (' . $ResultsArr[$g_id][$user_id]['result'] . ')' : '0' ?></td>
                                <? endforeach; ?>
                            </tr>
                             <? endforeach; ?>
                             <tr>
                                <td colspan="3" style="font-weight:bold;">Результаты Тура <?= $g_tour?>:</td>
                                <? foreach ( $PlayersArr AS $user_id => $v ): ?>
                                <td><?= isset ( $sum_tour[$g_tour][$user_id] ) ? '<b>' . $sum_tour[$g_tour][$user_id] . '</b>' : '0' ?></td>
							 <? endforeach; ?>
						     </tr>
                        <? endforeach; ?>
                            <tr>
                                <td colspan="3" style="font-weight:bold; font-size: 18px;">TOTAL:</td>
                                <? foreach ( $PlayersArr AS $user_id => $v ): ?>
                                <td <?= $sum_total[$user_id] == max( $sum_total ) ? 'style="color:red;"' : '' ?>><?= isset ( $sum_total[$user_id] ) ? '<b>' . $sum_total[$user_id] . '</b>' : '0' ?></td>
							<? endforeach; ?>
						    </tr>
				<? endif; ?>

					</table>
                    <br>

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

