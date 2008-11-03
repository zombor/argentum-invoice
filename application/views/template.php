<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-language" content="en" />
		<title><?=$title?></title>
		<?=html::stylesheet('css/reset')?>
		<?=html::stylesheet('css/style')?>

		<?=html::script('js/jquery')?>
		<?=html::script('js/jquery.livequery')?>
		<?=html::script('js/effects')?>
	</head>
	<body>
		<div id="wrapper">
			<div id="header" class="clear">
				<ul id="nav">
					<li><?=html::anchor('', 'Home')?></li>
					<li><?=html::anchor('client', 'Clients')?></li>
					<li><?=html::anchor('project', 'Projects')?></li>
					<li><?=html::anchor('invoice', 'Invoices')?></li><?php if (Auth::instance()->logged_in('admin')):?>
					<li><?=html::anchor('admin/user/all', 'Users')?></li>
					<li><?=html::anchor('admin/operation_type/all', 'Operation Types')?></li><?php endif; ?>
					<li class="small"><?=html::anchor('user/index', 'My Account')?></li>
					<li class="small"><?=html::anchor('#', 'Settings')?></li>
					<li class="small"><?=html::anchor('user/logout', 'Logout')?></li>
				</ul>
				<div id="quicksearch">
				<?=form::open('project/search', array('method' => 'get'))?>
					<p><?=form::input('term')?> <?=form::submit('submit', 'Search Projects')?></p>
				<?=form::close()?>
				</div>
			</div>
			<div id="body" class="clear">
				<?=$body?>
			</div>
			<div id="footer">
				<div id="copyright">&copy; 2008 Argentum Team</div>
			</div>
		</div>
	</body>
</html>