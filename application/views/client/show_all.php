<h1>All Clients</h1>
<ul>
	<?php foreach ($clients as $client):?><li><?=html::anchor('client/view/'.$client->short_name, $client->company_name.' - '.$client->contact_first_name.' '.$client->contact_last_name)?>
	</li><?php endforeach?>
</ul>