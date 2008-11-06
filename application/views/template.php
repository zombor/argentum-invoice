<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-language" content="en" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title><?=$title?></title>
		<?=html::stylesheet(array('css/reset', 'css/style', 'css/print'), array('', '', 'print'))?>

		<?=html::script('js/jquery')?>
		<?=html::script('js/jquery.livequery')?>
		<?=html::script('js/effects')?>
	</head>
	<body>
		<div id="wrapper">
			<div id="header" class="clear">
				<?=html::image(array('src' => 'images/argentum_logo_tagline.png', 'alt' => 'Argentum', 'class' => 'clear'))?>
				<ul id="nav">
					<li><?=html::anchor('', 'Home')?></li>
					<li><?=html::anchor('client', 'Clients')?></li>
					<li><?=html::anchor('project', 'Projects')?></li>
					<li><?=html::anchor('invoice', 'Invoices')?></li>
					<li class="small"><?=html::anchor('user/index', 'My Account')?></li><?php if (Auth::instance()->logged_in('admin')):?>
					<li class="small"><?=html::anchor('admin/settings', 'Settings')?></li><?php endif; ?>
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