<h2>Argentum Installer</h2>
<p>Welcome to Argentum. This process will set up your initial Argentum enviornment.</p>
<p>In each step we will ask for some information.</p>
<h3>Config Status</h3>
<ul>
	<?php foreach ($configs as $name => $status):?><li><?=$name?>: <strong<?php if ( ! $status):?> style="color: red;"<?php endif;?>><?=$status ? 'Writable' : 'Not Writable'?></strong></li>
	<?php endforeach;?>
</ul>
<h3>Step 1: Database Information</h3>
<p>Please enter your database information:</p>
<?php if (isset($errors)):?><?=$errors?><?php endif;?>
<?=form::open('admin/settings/install/2')?>
<ul>
	<li><label for="host">Server Address:</label> <?=form::input('host', isset($host) ? $host : '')?> (Valid hostname for your mysql database server)</li>
	<li><label for="database">Database Name:</label> <?=form::input('database', isset($database) ? $database : '')?> (Database name, must already exist)</li>
	<li><label for="username">Username:</label> <?=form::input('username', isset($username) ? $username : '')?> (Valid username for the above database)</li>
	<li><label for="password">Password:</label> <?=form::input('password', isset($password) ? $password : '', array('autocomplete' => 'no'))?> (Valid password for the above database)</li>
	<li><label for="table_prefix">Table Prefix:</label> <?=form::input('table_prefix', 'AI_', isset($table_prefix) ? $table_prefix : '')?> (Table prefix for this Argentum installer)</li>
	<li><label for="persistent">Use Persistent Connection:</label> <?=form::dropdown('persistent', array(FALSE => 'No', TRUE => 'Yes'), isset($persistent) ? $persistent : FALSE)?> (Use persistent connection when db server is on a seperate server)</li>
</ul>
<p><?=form::submit('continue', 'Go to Step 2')?></p>
<?=form::close()?>