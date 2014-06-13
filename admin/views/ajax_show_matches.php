<table cellpadding="2" cellspacing="2" border="1" width="600">
<tr style="white-space: nowrap;">
	<td>No</td>
    <td>Тур</td>
	<td>Ком. 1</td>
    <td>Ком. 2</td>
	<td>Дата</td>
	<td>Комментарии</td>
	<td>Результат</td>
	<td>Редактировать</td>
</tr>

<? if ( !count ( $MatchesArr ) ):?>
<tr><td colspan="6">Матчей не найдено</td></tr>
<? else : ?>
	<? foreach ( $MatchesArr AS $row ): ?>
	<? $i++ ?>
	<tr>
		<td><?= $i?></td>
        <td><?= $row['g_tour']?></td>
        <td><?= $TeamsArr[$row['g_team1']]?></td>
        <td><?= $TeamsArr[$row['g_team2']]?></td>
		<td style="white-space:nowrap;"><?= ShortDate( $row['g_date_time'] )?></td>
		<td>&nbsp;<?= $row['g_remarks']?></td>
		<td>&nbsp;<?= $row['g_result']?></td>
		<td align="center"><img src="/icon/edit.gif" title="Edit" style="cursor:pointer;" onclick="ShowWindow('./?todo=match_edit&select_game=<?= $row['g_id']?>&no_links=1', 'Edit game', 600, 500);"></td>
	</tr>
	<? endforeach; ?>
<? endif; ?>

</table>