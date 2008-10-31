<h2>User Login</h2>
<?=form::open('user/login')?>
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
<?=form::close()?>