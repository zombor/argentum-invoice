<h2>Manage Clients</h2>

<ul class="submenu clear">
	<li><?=html::anchor('admin/client/add', html::image('images/buttons/client_new.gif'))?></li>
</ul>

<div id="client_list">
	<ul>
		<?php foreach ($clients as $client):?> 
		<li>
			<a href="<?=url::site('client//view/'.$client->short_name)?>">
			<span class="company"><?=$client->company_name?></span> 
			<span class="contact"><?=html::mailto($client->email_address, $client->contact_full_name(), array('title' => 'Email Company Contact'))?> </span>
			</a>
		</li>
		<?php endforeach?>
	</ul>
</div>