<?php

// define the IP address BEFORE loading the library.
define('QS_DBG_ALLOWED_IPS', '127.0.0.1,1.2.3.4' );

require_once __DIR__ . '/qs_dbg.php';

// debug simple variable.
qs_dbg("My data");

// debug an array
qs_dbg([
	'complex' => [
		'site_url' => 'https://qSandbox.com',
		'title' => 'WordPress staging sites',
	],
]);
