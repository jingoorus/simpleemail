<?php
require_once('email.class.php');

$mail = new SimpleEmail([

	'from' => 'string',

	'to' => 'string',

	'subject' => 'string',

	'body' => 'string')
]);

$mail->set(['to' => 'string']);//add another to

$mail->set(['subject' => 'string']);//replace subject

$mail->send();
?>
