<h2>Edit Non-Hourly Item</h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="quantity">Quantity:</label> <?=form::input('quantity', isset($quantity) ? $quantity : $non_hourly->quantity)?></li>
	<li><label for="description">Description:</label><br /><?=form::textarea(array('name' => 'description', 'value' => isset($description) ? $description : $non_hourly->description))?></li>
	<li><label for="cost">Total Cost:</label> <?=form::input('cost', isset($cost) ? $cost : $non_hourly->cost)?></li>
	<li><?=form::submit('submit', 'Update Non-Hourly Item')?></li>
</ul>
<?form::close()?>