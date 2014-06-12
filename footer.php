<!-- end page -->
<div id="footer">
	<p class="copyright">&copy;&nbsp;&nbsp;<?= ( date ( "Y" ) != '2010' ? '2010-' : '' ) . date ( "Y" ) ?> Bets &nbsp;&bull;&nbsp; Сделал <a href="mailto:S.Vetko@fcmifi.ru">Сергей Ветко</a>.
<? echo " Page generated in $time_exec seconds" . ( $cache_html ? ' (Cached version)' : '' );  ?>	
</p>
</div>

<? if ( !$local_server && 0 ): ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10557416-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<? endif; ?>

</body>
</html>
