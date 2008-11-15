<h2>User Settings</h2>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Please see the errors below:</h3><?php endif;?>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="user[first_name]">First Name</label> <?=form::input('user[first_name]', $user->first_name)?></li>
	<li><label for="user[last_name]">Last Name</label> <?=form::input('user[last_name]', $user->last_name)?></li>
	<li><label for="user[email]">Email</label> <?=form::input('user[email]', $user->email)?></li>
</ul>
<?php Event::run('argentum.user_settings_display', $user)?>
<p><?=form::submit('save', 'Save Settings')?></p>
<?=form::close()?>