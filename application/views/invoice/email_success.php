<h2>Invoice Email Success</h2>
<p>The invoice was successfully emailed to:</p>
<?php foreach ($to as $contact):?><p><?=$contact->email?></p>
<?php endforeach;?>