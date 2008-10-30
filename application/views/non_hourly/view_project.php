<h1>View Non-Hourly Items For <?=html::anchor('project/view/'.$this->uri->segment(3), 'Project ID '.$this->uri->segment(3))?></h1>
<table>
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
			<td><?=html::anchor('admin/non_hourly/edit/'.$non_hourly->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Non Hourly')))?></td>
		</tr><?php endforeach;?>
	</tbody>
</table>