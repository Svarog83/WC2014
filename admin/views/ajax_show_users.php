<table cellpadding="2" cellspacing="2" border="1" width="600">
<tr>
	<td>ID</td>
	<td>Login</td>
	<td>Имя</td>
	<td>Фамилия</td>
	<td>E-mail</td>
	<td>State</td>
	<td>Role</td>
	<td>Block</td>
	<td>Edit</td>
</tr>

<? if ( !count ( $UsersArr ) ):?>
<tr><td colspan="9">No users found</td></tr>
<? else : ?>
	<? foreach ( $UsersArr AS $row ): ?>
	<tr>
		<td><?= $row['user_id']?></td>
		<td><?= $row['user_login']?></td>
		<td><?= $row['user_name']?></td>
		<td><?= $row['user_fam']?></td>
		<td><?= $row['user_email']?></td>
		<td id="td_state_<?= $row['user_id']?>"><?= strtoupper ( $row['user_state'] )?></td>
		<td><?= $row['user_role']?></td>
		<td align="center">&nbsp;
		<? if ( $row['user_id'] != $UA['user_id'] ): ?>
		<img src="/icon/exit.gif" title="Block/Unblock" style="cursor:pointer;" onclick="block_user(<?= $row['user_id']?>);">
		<? endif; ?>
		</td>
		<td align="center"><img src="/icon/edit.gif" title="Edit" style="cursor:pointer;" onclick="ShowWindow('./?todo=user_edit&select_user=<?= $row['user_id']?>&no_links=1', 'New user', 600, 500);"></td>
	</tr>
	<? endforeach; ?>
<? endif; ?>

</table>