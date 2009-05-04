<h2>Users</h2>
<ul>
	<li><?=html::anchor('admin/user/add', 'Create new user');?></li>
</ul>

<ul>
<? foreach ($users as $user): ?> 
	<li><?=$user->username ?> (<?=html::anchor('admin/user/edit?id='.$user->id, 'edit')?>)</li> 
<? endforeach; ?>
</ul>