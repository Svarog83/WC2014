    <li>
		<h2>Тур <?php echo $S_TOUR?></h2>
		<ul>
			<? foreach ( $cMatchesArr AS $row ): ?>
			<li>
				<?= getTeamName( $row['g_team1'] ) . '-' . getTeamName( $row['g_team2'] )  ?>
                <?= $row['g_remarks'] ? '<span style="color:red;">(' . $row['g_remarks'] . ')</span>' : '' ?>
				<b><?= isset ( $cMatchResults[$row['g_id']] ) ? $cMatchResults[$row['g_id']] : '-' ?></b>
			</li>
			<? endforeach; ?>
		</ul>
	</li>
