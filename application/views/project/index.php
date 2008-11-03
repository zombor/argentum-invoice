<h2><?=$title;?></h2>

<div id="project-buttons" class="button-bar">
	<?=html::anchor('admin/project/add', 'New Project')?> 
	/ <?=html::anchor('project', 'Active')?> 
	/ <?=html::anchor('project/show_all', 'All')?>
</div>

<?=$project_list;?>