<h2>Edit Invoice #<?=$invoice->id?></h2>
<?=form::open()?>
	<ul>
		<li><label for="title">Title:</label> <input name="title" id="title" value="<?=$invoice->title?>" /></li>
		<li><label for="comments">Comments:</label> <textarea name="comments" id="comments"><?=$invoice->title?></textarea></li>
		<li><label for="currency_id">Currency:</label> <?=form::dropdown('currency_id', Auto_Modeler_ORM::factory('currency')->select_list('id', 'name'), $invoice->currency_id)?></li>
		<li><label for="conversion_rate">Conversion Rate:</label> <input name="conversion_rate" id="conversion_rate" value="<?=$invoice->conversion_rate?>" /></li>
	</ul>
</form>