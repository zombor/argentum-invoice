<h2>Application Settings</h2>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Please see the errors below:</h3><?php endif;?>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="company_name">Company Name:</label> <?=form::input('company_name', $settings->company_name)?></li>
	<li><label for="company_address">Company Address:</label> <?=form::input('company_address', $settings->company_address)?></li>
	<li><label for="company_city">Company City:</label> <?=form::input('company_city', $settings->company_city)?></li>
	<li><label for="company_state">Company State:</label> <?=form::input('company_state', $settings->company_state)?></li>
	<li><label for="company_zip">Company ZIP:</label> <?=form::input('company_zip', $settings->company_zip)?></li>
	<li><label for="default_currency">Default Currency:</label> <?=form::dropdown('default_currency', Auto_Modeler_ORM::factory('currency')->select_list('id', array('name', 'symbol')), $settings->default_currency)?></li>
	<li><?=form::submit('update', 'Update Settings')?></li>
</ul>
<?=form::close()?>