<h2>User Login</h2>
<?=form::open()?>
<ul>
	<li>
		<?=form::label('username', 'Username')?>
		<?=form::input('username')?>
	</li>
	
	<li>
		<?=form::label('password', 'Password')?>
		<?=form::password('password')?>
	</li>