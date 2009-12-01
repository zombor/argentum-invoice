<?php echo '<'.'?php'?>

$config['default'] = array
(
	'benchmark'     => TRUE,
	'persistent'    => <?=$persistent?>,
	'connection'    => array
	(
		'type'     => 'mysql',
		'user'     => '<?=$username?>',
		'pass'     => '<?=$password?>',
		'host'     => '<?=$host?>',
		'port'     => FALSE,
		'socket'   => FALSE,
		'database' => '<?=$database?>'
	),
	'character_set' => 'utf8',
	'table_prefix'  => '<?=$table_prefix?>',
	'object'        => TRUE,
	'cache'         => TRUE,
	'escape'        => TRUE
);