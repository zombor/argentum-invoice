<h1>User Login</h1>
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