<?php

/**
 * Requirements Checker: This script will check if your system meets
 * the requirements for running Nette Framework.
 */


if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) || !isset($_SERVER['REMOTE_ADDR']) ||
	!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']))
{
	header('HTTP/1.1 403 Forbidden');
	echo 'Requirements Checker is available only from localhost';
	for ($i = 2e3; $i; $i--) echo substr(" \t\r\n", rand(0, 3), 1);
	exit;
}

phpinfo();