<h2>Argentum Installer</h2>
<p>Database tables and admin user saved successfuly. Now we will set the main Argentum preferences:</p>
<h3>Step 3: Settings Creation</h3>
<?php if (isset($errors)):?><?=$errors?><?php endif;?>
<?=form::open('admin/settings/install/4')?>
<ul>
	<li><label for="company_name">Company Name:</label> <?=form::input('company_name', isset($company_name) ? $company_name : '')?></li>
	<li><label for="company_address">Company Address:</label> <?=form::input('company_address', isset($company_address) ? $company_address : '')?></li>
	<li><label for="company_city">Company City:</label> <?=form::input('company_city', isset($company_city) ? $company_city : '')?></li>
	<li><label for="company_state">Company State:</label> <?=form::input('company_state', isset($company_state) ? $company_state : '')?></li>
	<li><label for="company_zip">Company ZIP:</label> <?=form::input('company_zip', isset($company_zip) ? $company_zip : '')?></li>
	<li><label for="default_currency">Default Currency:</label> <?=form::dropdown('default_currency', Auto_Modeler_ORM::factory('currency')->select_list('id', array('name', 'symbol')), isset($default_currency) ? $default_currency : '')?></li>
</ul>
<p><?=form::submit('continue', 'Finalize Install Process')?></p>
<?=form::close()?>