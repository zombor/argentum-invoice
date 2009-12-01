<h2>Timesheet</h2>
<table>
	<tbody>
		<tr>
			<td></td>
		<?php for($i = $start_date; $i <= $end_date; $i+=86400):?>
			<td><?=date('Y/m/d', $i)?></td>
		<?php endfor;?>
		</tr>
		<?php for($i = 0; $i <= 86400; $i+=900): //Go down in 15 minute blocks?><tr>
		<td><?=date('g:i A', mktime(0, 0, $i, 1, 1, 1))?></td>
		<?php for($j = $start_date; $j <= $end_date; $j+=86400): // Go across for each day?><td>
			<?php if ($tickets = $_SESSION['auth_user']->has_time($j+$i)):?>
				<?php foreach ($tickets as $ticket_id):?><?=html::anchor('ticket/view/'.$ticket_id, $ticket_id, array('class' => 'view_ticket'))?><?php endforeach; ?>
			<?php endif; ?>
		</td><?php endfor; ?>
		</tr><?php endfor; ?>
	</tbody>
</table>