<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<title><?=$title?></title>
		<?=html::stylesheet(array('css/reset', 'css/layout', 'css/style', 'css/print', 'css/jqmodal'), array('', '', '', 'print', ''))?>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<?=html::image(array('src' => 'images/argentum_logo_tagline.png', 'alt' => 'Argentum', 'class' => 'clear'))?>
			</div>
			<div id="navigation">
				&nbsp;
			</div>
			<div id="quicksearch">
				&nbsp;
			</div>
			<div class="clear">
				&nbsp;
			</div>
			<div id="content" style="margin-top: 25px;">
				<?=$content?>
			</div>
			<div id="footer">
				&copy; 2009 Argentum Team
			</div>
		</div>
	</body>
</html>