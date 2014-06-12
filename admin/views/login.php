<? if ( !$login_success ): ?>
<h3>No user found. Please try again.</h3>
<a href="/admin/">Try again</a>
<br>
<br>
<? endif;?>

<? if ( $login_success ): ?>
Welcome, dear administrator!

<a href="index.php?todo=list_users">List of users</a>

<? endif;?>