<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-language" content="en" />
		<meta http-equiv="content-type" content="charset=utf-8" />
		<title>Argentum Invoice Error</title>
		<?=html::stylesheet(array('css/reset', 'css/layout', 'css/style', 'css/print'),
		                    array('', '', '', 'print'))?>

	</head>
	<body>
		<div id="body">
			<div id="header">
					<?=html::image(array('src' => 'images/argentum_logo_tagline.png', 'alt' => 'Argentum', 'class' => 'clear'))?>
			</div>
			<div id="navigation">
				<ul id="nav">
					<li><?=html::anchor('', 'Home')?></li>
				</ul>
			</div>
			<div id="quicksearch">
				<?=form::open('project/search', array('method' => 'get'))?>
					<p><?=form::input('term')?> <?=form::submit('submit', 'Search Projects')?></p>
				<?=form::close()?>
			</div>
			<div class="clear">
				&nbsp;
			</div>
			<div id="content">
				<h2><?=$message?></h2>
				<p><?=Kohana::lang('core.error_file_line', $file, $line)?></p>
			</div>
			<div id="footer">
				<div id="copyright">&copy; 2008 Argentum Team</div>
			</div>
		</div>
	</body>
</html>
