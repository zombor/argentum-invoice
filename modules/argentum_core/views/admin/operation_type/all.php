<h2>All Operation Types</h2>
<ul>
	<li><?=html::anchor('admin/operation_type/add', 'Create new operation type');?></li>
</ul>

<ul>
<?php foreach ($operation_types as $operation_type): ?> 
	<li><?=$operation_type->name?> (<?=html::anchor('admin/operation_type/edit/'.$operation_type->id, 'edit')?>)</li> 
<? endforeach; ?>
</ul>