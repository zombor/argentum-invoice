<?php

/**
 * User add/edit form
 *
 * Expected vars:
 *		$title			String		Title of form
 *		$user			User_Model	User/Form user, attributes matching User_Model
 *		$user_roles		Array		Array of role id's that belong to the user
 *		$roles			Array		An array of all Role_Model s
 *		$errors			String		Form validation errors
 */

?>

<h2><?=$title?></h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li>
		<?=form::label('username', 'Username')?>
		<?=form::input('username', $user->username)?>
	</li>

	<li>
		<?=form::label('first_name', 'First Name')?>
		<?=form::input('first_name', $user->first_name)?>
	</li>

	<li>
		<?=form::label('last_name', 'Last Name')?>
		<?=form::input('last_name', $user->last_name)?>
	</li>

	<li>
		<?=form::label('password', 'Password')?>
		<?=form::password('password')?>
	</li>
	
	<li>
		<?=form::label('email', 'Email')?>
		<?=form::input('email', $user->email)?>
	</li>
	
	<li>
		<fieldset>
		<legend>User can:</legend>
		<ul>
			<?php foreach ($roles as $role): ?>
			<li>
				<?=form::checkbox(array('id' => 'role_'.$role->name, 'name' => 'roles[]'), $role->id, in_array($role->id, $user_roles))?>
				<?=form::label('role_'.$role->name, $role->name)?>
			</li>
			<? endforeach; ?>
		</ul>
		</fieldset>
	</li>
	<li>
		<?=form::submit('save', 'Save')?>
	</li>
</ul>

<?=form::close()?>