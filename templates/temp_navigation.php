<div id="header">
	<div id="menu">
		<ul id="main">
			<li <?= $todo == 'index' ? 'class="current_page_item"' : ''?>><a href="/">Домой</a></li>
			<li <?= $todo == 'calendar' ? 'class="current_page_item"' : ''?>><a href="/calendar/">Календарь</a></li>
			<li <?= $todo == 'results' ? 'class="current_page_item"' : ''?>><a href="/results/">Результаты</a></li>
			<? if ( $user_authorized && $UA['user_role'] == 'adm' ): ?>
			<li><a href="/admin/?todo=list_matches">Админка</a></li>
			<? endif ; ?>
		</ul>
	</div>
	<div id="time">
	Сегодня: <?= date ( "Y-m-d H:i" ) ?>
	</div>
</div>