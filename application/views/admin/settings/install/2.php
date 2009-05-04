<h2>Argentum Installer</h2>
<p>Database settings saved successfuly. Now we will create your admin user account:</p>
<h3>Step 2: Admin User Creation</h3>
<?php if (isset($errors)):?><?=$errors?><?php endif;?>
<?=form::open('admin/settings/install/3')?>
<ul>
	<li><label for="username">Username:</label> <?=form::input('username', $user->username)?></li>
	<li><label for="password">Password:</label> <?=form::password('password')?></li>
	<!--<li><label for="password_repeat">Repeat Password:</label> <?=form::password('password_repeat')?></li>-->
	<li><label for="email">Email:</label> <?=form::input('email', $user->email)?></li>
	<li><label for="first_name">First Name:</label> <?=form::input('first_name', $user->first_name)?></li>
	<li><label for="last_name">Last Name:</label> <?=form::input('last_name', $user->last_name)?></li>
</ul>
<p><?=form::submit('continue', 'Go To Step 3')?></p>
<?=form::close()?>