<script type="text/javascript" src="/javascripts/prototype.js"> </script> 
<script type="text/javascript" src="/javascripts/window.js"> </script>
<script type="text/javascript" src="/javascripts/get_random.js"> </script> 
<link href="/javascripts/default.css" rel="stylesheet" type="text/css" >	 </link>

<script language="JavaScript">
<!--

var contentWin;
function ShowWindow( src_url, win_title, size_w, size_h)
{
	if ( !size_w )
		size_w = 550;
		
	if ( !size_h )
		size_h = 350;
		
	var last_char = src_url.substr((src_url.length-1),1);
	
	if ( last_char != '&' && last_char != '?' )
		src_url += ( src_url.indexOf( '?' ) == -1 ? '?' : '&' );
		
	src_url += getrandom();
	
	if ( contentWin == null )
	{
		contentWin = new Window('window_id', {url: src_url, title: win_title, width:size_w, height:size_h, minimizable:false, maximizable:false});
		contentWin.setDestroyOnClose();
		contentWin.showCenter(true);
	}
	else
	{
		contentWin.destroy();
	}
	
	myObserver = {
			    onDestroy: function(eventName, win) {
			      if (win == contentWin) {
			        contentWin = null;
			        Windows.removeObserver(this);
			      }
			    }
			  }
			  Windows.addObserver(myObserver);
}
//-->
</script>