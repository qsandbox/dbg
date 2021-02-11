<?php

defined( 'QS_DBG_CLI' ) || define('QS_DBG_CLI', php_sapi_name() == 'cli' || ( defined( 'WP_CLI' ) && WP_CLI ) );
defined( 'QS_DBG_IS_AJAX' ) || define('QS_DBG_IS_AJAX', !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' );
defined( 'QS_DBG_ALLOWED_IPS' ) || define('QS_DBG_ALLOWED_IPS', '127.0.0.1,1.2.3.4' );

/**
 * This is the debugging function. Simple and effective.
 * It checks for a whitelisted IP address and if is not skips the debugging.
 * Skips debug in ajax requests.
 * Here's the blog post with explanations - https://qsandbox.com/p927
 * @param mixed $data
 * @param string $title (optional)
 * @author Svetoslav Marinov (Slavi) | https://qsandbox.com
 */
function qs_dbg($data, $title = '') {
	if (QS_DBG_IS_AJAX) {
		return;
	}

	$allowed_ips = preg_split('#[\s,|]+#si', QS_DBG_ALLOWED_IPS);
	$allowed_ips = array_unique($allowed_ips); // no dups
	$allowed_ips = array_filter($allowed_ips); // rm empty ones

	if (empty($allowed_ips)) {
		return;
	}

	// IP not allowed, don't do anything
	if (empty($_SERVER['REMOTE_ADDR']) || ! in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
		return;
	}

	// We'll capture the output here and save it into a buffer.
	ob_start();
	if (is_scalar($data)) {
		echo $data;
	} else {
		var_dump($data); // don't use var_export() as it may crash the php with circular references error
	}

	$buff = ob_get_clean();

	if (function_exists('esc_html')) {
		$esc_buff = esc_html($buff); // WordPress
	} else {
		$esc_buff = htmlentities( $buff, ENT_QUOTES, 'UTF-8' );
	}

	echo "\n<pre style='background: #AE5946; color: #fff; padding: 3px;margin: 10px 0;font-family: monospace;'>";

	if (!empty($title)) {
		$title_esc = function_exists('esc_html')
			? esc_html($title)
			: htmlentities( $title, ENT_QUOTES, 'UTF-8' );
		echo "<h3>$title_esc</h3>";
	}

	echo $esc_buff;
	echo "</pre>\n";
}
