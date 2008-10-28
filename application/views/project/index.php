<h2>Search for a project</h2>
<?=form::open('project/search', array('method' => 'get'))?>
	<p><?=form::input('term')?> <?=form::submit('submit', 'Search')?></p>
<?=form::close()?>
<h3><?=html::anchor('project/show_all', 'Display All Projects')?></h3>
<h3><?=html::anchor('admin/project/add', 'Create New Project')?></h3>