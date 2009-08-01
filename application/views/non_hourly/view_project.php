<h2>View Non-Hourly Items For <?=html::anchor('project/view/'.$project->id, 'Project ID '.$project->id.': '.$project->name)?></h2>
<?php include Kohana::find_file('views', 'project/menu')?>
<table class="non_hourly">
	<tbody>
		<tr>
			<th>ID</th>
			<th>Quantity</th>
			<th>Description</th>
			<th>Cost</th>
			<th>Admin</th>
		</tr>
		<?php foreach ($non_hourlies as $non_hourly):?><tr>
			<td><?=$non_hourly->id?></td>
			<td><?=$non_hourly->quantity?></td>
			<td><?=$non_hourly->description?></td>
			<td><?=$non_hourly->cost?></td>
			<td><?=$non_hourly->invoiced ? html::anchor('invoice/view/'.$non_hourly->invoice_id, $non_hourly->invoice_id) : html::anchor('admin/non_hourly/edit/'.$non_hourly->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Non Hourly')))?></td>
		</tr><?php endforeach;?>
	</tbody>
</table>