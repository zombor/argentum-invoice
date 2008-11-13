<h2>Invoices</h2>
<ul class="submenu clear">
	<li><?=html::anchor('invoice/list_all', 'View All Invoices')?></li>
</ul>

<h3>Create Invoice</h3>
<?=form::open('admin/invoice/create', array('method' => 'get'))?>
<p>Choose a client to create an invoice for:</p>
<p><?=form::dropdown('client_id', Auto_Modeler_ORM::factory('client')->select_list('id', 'company_name'))?></p>
<p><?=form::submit('create', 'Start Creation Process')?></p>
<?=form::close()?>