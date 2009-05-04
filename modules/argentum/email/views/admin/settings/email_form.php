<h2>Email Plugin Configuration Options</h2>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Please see the errors below:</h3><?php endif;?>
<?=$errors?>
<?=form::open()?>
<p>Driver: <?=form::dropdown('driver', array('native' => 'Native', 'sendmail' => 'Sendmail', 'smtp' => 'SMTP'), Kohana::config('email.driver'))?></p>
<h3>Sendmail Options</h3>
<p>Sendmail Path: <?=form::input('sendmail_path', Kohana::config('email.driver') == 'sendmail' ? Kohana::config('email.options') : '')?></p>
<h3>SMTP Options</h3>
<p>SMTP Hostname: <?=form::input('hostname', Kohana::config('email.driver') == 'smtp' ? Kohana::config('email.options.hostname') : '')?></p>
<p>SMTP Username: <?=form::input('username', Kohana::config('email.driver') == 'smtp' ? Kohana::config('email.options.username') : '')?></p>
<p>SMTP Password: <?=form::input('password', Kohana::config('email.driver') == 'smtp' ? Kohana::config('email.options.password') : '')?></p>
<p><?=form::submit('go', 'Save Settings')?></p>
<?=form::close()?>