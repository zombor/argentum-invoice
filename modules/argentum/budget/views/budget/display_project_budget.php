<h3>Project Budget</h3>
<ul>
	<li><strong>Allocated Budget:</strong> <?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?><?=$project_budget->amount?></li>
	<li><strong>Spent Budget:</strong> <span class="<?=$project->total_cost() > $project_budget->amount ? 'due_date' : ''?>"><?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?><?=$project->total_cost()?></span></li>
</ul>