<h2>Invoices</h2>
<ul>
	<li><?=html::anchor('invoice/list_all', 'View All Invoices')?></li>
</ul>

<h2>Create Invoice</h2>
<?=form::open('invoice/create', array('method' => 'get'))?>
<p>Choose a client to create an invoice for:</p>
<p><?=form::dropdown('client_id', Auto_Modeler_ORM::factory('client')->select_list('id', 'company_name'))?></p>
<p><?=form::submit('create', 'Start Creation Process')?></p>
<?=form::close()?>