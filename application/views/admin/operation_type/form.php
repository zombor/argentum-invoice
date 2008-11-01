<h2><?=$action?> Operation Type</h2>
<?=$errors?>
<?=form::open()?>
<?=form::hidden('id', $operation_type->id)?>
<ul>
	<li>
		<?=form::label('name', 'Name')?>
		<?=form::input('name', $operation_type->name)?>
	</li>
	<li>
		<?=form::label('rate', 'Rate')?>
		<?=form::input('rate', $operation_type->rate)?>
	</li>
	<li>
		<?=form::submit('submit', $action.' Operation Type')?>
	</li>
</ul>
<?=form::close()?>