<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<title>Invoice #<?=$invoice->id?></title>
		<style type="text/css">
			#billing_client .client {
				width: 25%;
			}

			#invoice table {
				width: 99%;
				margin-top: 2em;
				border: 1px solid black;
			}

			#invoice th {
				font-weight: bold;
				border-bottom: 1px solid black;
			}

			#invoice tr.uneven {
				background-color: #CCC;
			}

			#invoice tr.subtotal td {
				border-top: 3px dashed black;
			}

			#invoice .total td {
				font-weight: bold;
				border-top: 2px solid black;
			}

			#billing_client {
				width: 99%;
				border: none;
			}

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