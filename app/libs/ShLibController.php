<?php

use App\Model\WifiAp;

class ShLibController
{
	const SH_DIR = '/var/www/public/app/shLib/';


	const SSID_DEFAULT = 'hackberry';
	const PASS_DEFAULT = 'toor1234';
	const IP_ADDRESS = 'inet';
	const MAC_ADDRESS = 'ether';




	/**
	 * @return array
	 * @throws Exception
	 */
	public function getNetworkDevices()
	{
		$networkDevicesString = $this->runBashScript('show_net_devices.sh');
		$devicesInLines = DevTools::makeOutputLines($networkDevicesString);
		$macAndIp = self::getIpAndMac();
		return ShLibDataShaping::createNetworkDeviceList($devicesInLines,$macAndIp);
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
		$string = 'create_wifi_ap.sh -p ' . self::PASS_DEFAULT . ' -s ' . self::SSID_DEFAULT . ' -w '.$wlan;
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
		$string = 'delete_wifi_ap.sh -s ' . self::SSID_DEFAULT . ' -w '.$wlan;
		$scriptOutput = $this->runBashScript($string);
		return $scriptOutput;
	}

	/**
	 * @return array
	 */
	public function getWifiAp(){
		$wifiApString = $this->runBashScript('show_wifi_ap.sh');
		$wifiApLines = DevTools::makeOutputLines($wifiApString);
		return ShLibDataShaping::createWifiApsList($wifiApLines);
	}

	/**
	 * @throws Exception
	 */
	public function getIpAndMac(){
		$networkDevicesInfo = $this->runBashScript('ifconfig.sh');
		$devices = [];
		foreach(DevTools::makeOutputLines($networkDevicesInfo) as $networkDevicesInfoLine){
			if (strpos($networkDevicesInfoLine, 'flags') !== false) {
				$networkDevicesInfoLineExplode = explode(': flags',$networkDevicesInfoLine);
				$devices[] = $networkDevicesInfoLineExplode[0];
			}
		}

		$firstCut = [];
		$devicesInfo = [];
		foreach ($devices as $device){
			$devicesInfo[$device]['ip'] = '';
			$devicesInfo[$device]['mac'] = '';

			$firstCut[$device] = DevTools::getStringBetween($networkDevicesInfo,$device,'RX');
			if (strpos($firstCut[$device], self::IP_ADDRESS) !== false) {
				$devicesInfo[$device]['ip'] = trim(DevTools::getStringBetween($firstCut[$device],self::IP_ADDRESS,'netmask'));
			}
			if (strpos($firstCut[$device], self::MAC_ADDRESS) !== false) {
				$devicesInfo[$device]['mac'] = trim(DevTools::getStringBetween($firstCut[$device],self::MAC_ADDRESS,'txqueuelen'));
			}

		}

		return $devicesInfo;
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
