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

	/**
	 * @param $processName
	 * @return bool
	 */
	public function isProcessRunning($processName){
		$result = $this->runBashScript('ps aux | pgrep ' . $processName);
		if (empty($result)){
			return false;
		}
		return true;
	}

	/**
	 * @param $processName
	 * @return string|null
	 */
	public function killProcess($processName){
		shell_exec('sudo pkill -9 ' . $processName);
	}

	/**
	 * @return string|null
	 */
	public function clearCache(){
		return $this->runBashScript('clear_cache.sh');
	}

}
