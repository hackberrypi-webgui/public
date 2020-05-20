<?php

class ShLibController
{
	const SH_DIR = '/var/www/public/app/shLib/';

	const DEVICE = 'DEVICE:';
	const TYPE = 'TYPE:';
	const STATE = 'STATE:';
	const CONNECTION = 'CONNECTION:';
	const SSID = 'hackberry';
	const PASS = 'toor1234';

	/**
	 * @return array
	 */
	public function getNetworkDevices()
	{
		$networkDevicesString = $this->runBashScript('show_wifi_devices.sh');
		$devicesInLines = DevTools::makeOutputLines($networkDevicesString);

		$devices = [];
		$netDevice = new NetDevice();

		foreach ($devicesInLines as $deviceInLine){

			if (strpos($deviceInLine, self::DEVICE) !== false) {
				$netDevice->setDevice(trim(str_replace(self::DEVICE,'',$deviceInLine)));
			}
			if (strpos($deviceInLine, self::TYPE) !== false) {
				$netDevice->setType(trim(str_replace(self::TYPE,'',$deviceInLine)));
			}
			if (strpos($deviceInLine, self::STATE) !== false) {
				$netDevice->setState(trim(str_replace(self::STATE,'',$deviceInLine)));
			}
			if (strpos($deviceInLine, self::CONNECTION) !== false) {
				$netDevice->setConnection(trim(str_replace(self::CONNECTION,'',$deviceInLine)));
				$devices[]=$netDevice;
				$netDevice = new NetDevice();
			}
		}
		return $devices;
	}

	/**
	 * @param $wlan
	 * @return string|null
	 * @throws Exception
	 */
	public function createWifiAp($wlan){
		if (empty($wlan)){
			throw new Exception('Empty string!');
		}
		$string = 'create_wifi_ap.sh -p ' . self::PASS . ' -s ' . self::SSID . ' -w '.$wlan;
		$scriptOutput = $this->runBashScript($string);
		return $scriptOutput;
	}

	/**
	 * @param $wlan
	 * @return string|null
	 * @throws Exception
	 */
	public function deleteWifiAp($wlan){
		if (empty($wlan)){
			throw new Exception('Empty string!');
		}
		$string = 'delete_wifi_ap.sh -s ' . self::SSID . ' -w '.$wlan;
		$scriptOutput = $this->runBashScript($string);
		return $scriptOutput;
	}

	public function checkWifiAp($wlan){

	}

	public function getWifiSignal(){

	}

	public function getIpAndMac(){
		$networkDevicesInfo = $this->runBashScript('ifconfig.sh');
		dump(DevTools::makeOutputLines($networkDevicesInfo));
		exit();
	}


	/**
	 * @param $scriptName
	 * @return string|null
	 */
	public function runBashScript($scriptName)
	{
		return shell_exec('cd ' . self::SH_DIR . ' && ./' . $scriptName);
	}

}
