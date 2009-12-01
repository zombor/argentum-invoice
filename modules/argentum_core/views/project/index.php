<h2><?=$title;?></h2>

<ul class="submenu clear">
	<li><?=html::anchor('admin/project/add', html::image('images/buttons/project_new.gif'))?> </li>
	<li><?=html::anchor('project', 'Active')?></li>
	<li><?=html::anchor('project/show_all', 'All')?></li>
</ul>

<?=$project_list;?>