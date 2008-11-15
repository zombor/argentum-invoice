<h2>Module Settings</h2>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Update was not successful</h3><?php endif;?>
<p>Check or uncheck the modules you want to activate.</p>
<?=form::open()?>
<ul>
	<?php foreach ($modules as $module => $status):?><li><?=form::checkbox($module, TRUE, $status)?> <label for="<?=$module?>"><?=$module?></label></li>
	<?php endforeach;?>
</ul>
<p><?=form::submit('go', 'Update Modules')?></p>
<?=form::close()?>