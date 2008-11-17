<h2>Settings</h2>
<ul>
	<li><?=html::anchor('admin/settings/application', 'Application Settings')?></li>
	<li><?=html::anchor('admin/settings/modules', 'Modules')?></li>
	<li><?=html::anchor('admin/user/all', 'User Admin')?></li>
	<li><?=html::anchor('admin/operation_type/all', 'Operation Type Admin')?></li>
	<?php Event::run('argentum.system_settings_display')?>
</ul>