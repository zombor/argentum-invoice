<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<title><?=$title?></title>
		<?=html::stylesheet(array('css/reset', 'css/layout', 'css/style'))?>
		<?php if (Auth::instance()->logged_in()) page::render('stylesheet')?>

		<?=html::script('js/lib/jquery')?>
		<?=html::script('js/lib/livequery')?>
		<?php if (Auth::instance()->logged_in()) page::render('javascript')?>
	</head>
	<body>
		<?=$body?>
	</body>
</html>