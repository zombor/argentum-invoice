<h1>My Account</h1>
<p>View your timesheet using the form below:</p>
<?=form::open('user/timesheet', array('method' => 'get'))?>
<p>Start Time: <?=form::dropdown('start_date[year]', date::years(2008, date('Y')), date('Y'))?>/<?=form::dropdown('start_date[month]', date::months(), date('n'))?>/<?=form::dropdown('start_date[day]', date::days(12), date('j'))?></p>
<p>End Time: <?=form::dropdown('end_date[year]', date::years(2008, date('Y')), date('Y'))?>/<?=form::dropdown('end_date[month]', date::months(), date('n'))?>/<?=form::dropdown('end_date[day]', date::days(12), date('j'))?></p>
<p><?=form::submit('view', 'View')?></p>
<?=form::close()?>