<?php
require_once('email.class.php');

$mail = new SimpleEmail([

	'from' => 'string',

	'to' => 'string',

	'subject' => 'string',

	'body' => 'string')
]);

$mail->send();
?>
