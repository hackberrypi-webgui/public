<?php


class BaseBashController
{
	const SH_DIR = '/var/www/public/app/shLib/';


	/**
	 * @param $scriptName
	 * @return string|null
	 */
	public function runBashScript($scriptName)
	{
		return shell_exec('cd ' . self::SH_DIR . ' && ./' . $scriptName);
	}

}
