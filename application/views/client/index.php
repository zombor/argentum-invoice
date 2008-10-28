<h2>Search for a client</h2>
<?=form::open('')?>
	<p><?=form::input('term')?> <?=form::submit('submit', 'Search')?></p>
<?=form::close()?>
<h3><?=html::anchor('client/show_all', 'Display All Clients')?></h3>
<h3><?=html::anchor('admin/client/add', 'Add A New Client')?></h3>