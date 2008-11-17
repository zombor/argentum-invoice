<h2>Module Settings</h2>
<p>Uninstalling a module will remove <strong>ALL</strong> module settings and database tables. this process is not recoverable.</p>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Update was not successful</h3><?php endif;?>
<p>Check or uncheck the modules you want to activate.</p>
<?=form::open()?>
<table>
	<tr>
		<th></th>
		<th>Module Name</th>
		<th>Active</th>
		<th>Installed</th>
		<th></th>
	</tr>
	<?php foreach ($modules as $module):?><tr>
		<td><?=form::checkbox($module->name, TRUE, $module->active)?></td>
		<td><label for="<?=$module->name?>"><?=ucwords(str_replace('_', ' ', $module->name))?></label></td>
		<td><?=$module->active ? html::image(array('src' => 'images/icons/tick.png', 'alt' => 'Active')) : html::image(array('src' => 'images/icons/cross.png', 'alt' => 'Not Active'))?></td>
		<td><?=$module->installed ? html::image(array('src' => 'images/icons/tick.png', 'alt' => 'Installed')) : html::image(array('src' => 'images/icons/cross.png', 'alt' => 'Not Installed'))?></td>
		<td><?=html::anchor('admin/settings/uninstall_module/'.$module->name, 'Uninstall')?></td>
	</tr><?php endforeach;?>
</table>
<p><?=form::submit('go', 'Activate/Install Selected Modules')?></p>
<?=form::close()?>