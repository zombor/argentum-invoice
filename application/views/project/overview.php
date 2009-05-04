<h2>New Tickets</h2>
<ul>
<?php foreach ($new_tickets as $ticket):?><li><?=html::anchor('ticket/active/'.$ticket->project_id, '#'.$ticket->id.' - '.text::limit_words(strip_tags($ticket->description), 10))?></li>
<?php endforeach;?> 
</ul>
<h2>Unpaid Invoices Over 30 Days Old</h2>
<ul>
<?php foreach ($unpaid_invoices as $invoice):?><li><?=html::anchor('invoice/view/'.$invoice->id, '#'.$invoice->id.' - '.$invoice->title)?></li>
<?php endforeach;?> 
</ul>
<h2>Projects With The Most Active Tickets</h2>
<ul>
<?php foreach ($projects as $project):?><li><?=html::anchor('project/view/'.$project->id, '#'.$project->id.' - '.$project->name.' - '.$project->ticket_count.' Tickets')?></li>
<?php endforeach;?> 
</ul>