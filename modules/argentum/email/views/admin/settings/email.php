<?php echo '<'.'?php'?>

$config['driver'] = '<?=$driver?>';

<?php if ($driver == 'smtp'):?>
$config['options'] = array('hostname' => '<?=$hostname?>', 'username' => '<?=$username?>', 'password' => '<?=$password?>');
<?php elseif ($driver == 'sendmail'):?>
$config['options'] = '<?=$sendmail_path?>';
<?php endif; ?>