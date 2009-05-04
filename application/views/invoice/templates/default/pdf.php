<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<title>Invoice #<?=$invoice->id?></title>
		<style type="text/css">
			#billing_client * {
				border: 0;
			}

			.download_pdf {
				display: none;
			}
		</style>
	</head>
	<body>
	<?php include Kohana::find_file('views', 'invoice/templates/default/view')?>
</body>
</html>