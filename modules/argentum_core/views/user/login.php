<h2>User Login</h2>
<?php if ($message = arr::remove('message', $_SESSION)):?><blockquote class="message bad"><?=$message?></blockquote><?php endif;?>
<?=form::open('user/login', array('id' => 'login_form'))?>
<ul>
	<li>
		<?=form::label('username', 'Username')?>
		<?=form::input('username')?>
	</li>
	
	<li>
		<?=form::label('password', 'Password')?>
		<?=form::password('password')?>
	</li>

	<li>
		<?=form::submit('login', 'Login')?>
	</li>
</ul>
</form>