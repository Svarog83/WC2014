<li>
		<h2>Последние новости</h2>
		<ul>
			<? foreach ( $cNewsArr AS $row ): ?>
			<li>
				<b><?= substr( $row['news_date'], 0, 10 ) ?></b> &nbsp;<?= $row['news_text']?>
			</li>
			<? endforeach; ?>
		</ul>
	</li>