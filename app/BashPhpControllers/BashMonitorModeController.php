<?php

class BashMonitorModeController extends BaseBashController
{

	/**
	 * @param $wlan
	 * @return string|null
	 */
	public function setDeviceIntoMonitorMode($wlan)
	{
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m monitor');
	}

	/**
	 * @param $wlan
	 * @return string|null
	 */
	public function setDeviceIntoAutoMode($wlan)
	{
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m auto');
	}

	/**
	 * @param $wlan
	 * @return string|null
	 */
	public function setDeviceIntoManagedMode($wlan)
	{
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m managed');
	}

	/**
	 * @param $wlan
	 * @return array|string|null
	 * @throws Exception
	 */
	public function getWifiAp($wlan)
	{
		$fileName = '../temp/cache/airodump_' . $wlan . '-01.csv';

		if ($this->isProcessRunning('airodump-ng')){
			if (file_exists($fileName)) {
				return $this->getWifiApArray($fileName);
			}else{
				$this->killProcess('airodump-ng');
				return [];
			}
		}else{
			if (file_exists($fileName)) {
				unlink($fileName = '../temp/cache/airodump_' . $wlan . '-01.csv');
			}
			$this->runBashScript('airodump_check.sh -w ' . $wlan);
			sleep(2);
			return $this->getWifiApArray($fileName);
		}
	}

	/**
	 * @param $fileName
	 * @return array
	 */
	private function getWifiApArray($fileName)
	{
		$result = [];
		$listOfAp = array_map('str_getcsv', file($fileName));
		foreach ($listOfAp as $ap){
			if (count($ap) > 8){
				$result[] = $ap;
			}
		}
		unset($result[0]);
		return $result;
	}

	/**
	 * @return array
	 */
	public static function getNameArray()
	{
		return [
			0 => 'BSSID',
			1 => 'First time seen',
			2 => 'Last time seen',
			3 => 'Channel',
			4 => 'Speed',
			5 => 'Privacy',
			6 => 'Cipher',
			7 => 'Authentication',
			8 => 'Power',
			9 => 'Beacons',
			10 => 'IV',
			11 => 'LAN IP',
			12 => 'ID-length',
			13 => 'ESSID',
			14 => 'Key'
		];
	}


}
