<?php if (Auto_Modeler_ORM::factory('live_timer')->is_ticket_active($ticket->id, $_SESSION['auth_user']->id)):?>
<?=html::anchor('live_timer/stop/'.$ticket->id, 'Stop Timer')?>
<?php else: ?>
<?=html::anchor('live_timer/start/'.$ticket->id, 'Start Timer')?>
<?php endif;?>