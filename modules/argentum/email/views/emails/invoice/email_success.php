<h2>Invoice Email Success</h2>
<p>The invoice was successfully emailed to:</p>
<ul>
	<?php foreach ($to as $contact):?><li><?=$contact->email?></li>
	<?php endforeach;?> 
</ul>