<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-language" content="en" />
		<title><?=$title?></title>
		<?=html::stylesheet('css/layout')?>
		<?=html::stylesheet('css/style')?>

		<?=html::script('js/jquery')?>
		<?=html::script('js/jquery.livequery')?>
		<?=html::script('js/effects')?>
	</head>
	<body>
		<div id="header">
			<ul id="nav">
				<li><?=html::anchor('', 'Home')?></li>
				<li><?=html::anchor('client', 'Clients')?></li>
				<li><?=html::anchor('project', 'Projects')?></li>
				<li><?=html::anchor('invoice', 'Invoices')?></li>
				<li><?=html::anchor('admin/user/all', 'List All Users')?></li>
				<li><?=html::anchor('user/logout', 'Logout')?></li>
			</ul>
		</div>
		<div id="body">
			<?=$body?>
			<div style="clear: both; padding-top: 35px;"></div>
		</div>
		<div id="footer">
			<div id="copyright">&copy; 2008 zombor.net</div>
		</div>
	</body>
</html>