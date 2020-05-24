<?php

class BashNetworkController extends BaseBashController
{
	const DEVICE = 'DEVICE:';
	const TYPE = 'TYPE:';
	const STATE = 'STATE:';
	const CONNECTION = 'CONNECTION:';
	const MODE = 'MODE:';
	const RATE = 'RATE:';

	const IP_ADDRESS = 'inet ';
	const MAC_ADDRESS = 'ether ';

	/**
	 * @return array
	 * @throws Exception
	 */
	public function getNetworkDevices()
	{
		$networkDevicesString = $this->runBashScript('show_net_devices.sh');
		$devicesInLines = DevTools::makeOutputLines($networkDevicesString);
		$macAndIp = $this->getIpAndMac();
		$chipsetAndDriver = $this->getChipsetAndDriver();
		$devicesMode = $this->getDeviceMode();
		return $this->createNetworkDeviceList($devicesInLines,$macAndIp,$chipsetAndDriver,$devicesMode);
	}

	/**
	 * @throws Exception
	 */
	private function getIpAndMac(){
		$networkDevicesInfoString = $this->runBashScript('ifconfig.sh');

		$devices = [];
		foreach(DevTools::makeOutputLines($networkDevicesInfoString) as $networkDevicesInfoLine){
			if (strpos($networkDevicesInfoLine, 'flags') !== false) {
				$networkDevicesInfoLineExplode = explode(': flags',$networkDevicesInfoLine);
				$devices[] = $networkDevicesInfoLineExplode[0];
			}
		}

		return $this->createDevicesInfo($devices, $networkDevicesInfoString);
	}


	/**
	 * @return array
	 */
	private function getChipsetAndDriver(){
		$chipsetAndDriversString = $this->runBashScript('airmon_ng.sh');

		$chipsetAndDrivers = [];
		foreach (DevTools::makeOutputLines($chipsetAndDriversString) as $key=>$chipsetAndDriverLine){

			$chipsetAndDriverExplode = explode('\t',$chipsetAndDriverLine);
			foreach ($chipsetAndDriverExplode as $chipsetAndDriver){
				if (!empty($chipsetAndDriver)){
					$chipsetAndDrivers[$key][] = $chipsetAndDriver;
				}
			}
		}
		unset($chipsetAndDrivers[1]);
		$chipsetAndDrivers = array_merge($chipsetAndDrivers,[]);

		$chipsetAndDriversAssoc = [];
		foreach($chipsetAndDrivers as $key=>$chipsetAndDriver){
			$chipsetAndDriversAssoc[$chipsetAndDriver[1]]=[
				'phy'=>$chipsetAndDriver[0],
				'driver'=>$chipsetAndDriver[2],
				'chipset'=>$chipsetAndDriver[3]
			];
		}

		return $chipsetAndDriversAssoc;
	}

	/**
	 * @param $devicesInLines
	 * @return array
	 * @throws Exception
	 */
	private function createNetworkDeviceList($devicesInLines, $macAndIp, $chipsetAndDriver, $devicesMode){
		$devices = [];
		$netDevice = new NetDevice();

		foreach ($devicesInLines as $deviceInLine){
			$deviceName = trim(str_replace(self::DEVICE,'',$deviceInLine));

			if (strpos($deviceInLine, self::DEVICE) !== false) {
				$netDevice->setDevice($deviceName);
			}
			if (strpos($deviceInLine, self::TYPE) !== false) {
				$netDevice->setType(trim(str_replace(self::TYPE,'',$deviceInLine)));
			}
			if (strpos($deviceInLine, self::STATE) !== false) {
				$netDevice->setState(trim(str_replace(self::STATE,'',$deviceInLine)));
			}
			if (isset($macAndIp[$deviceName])){
				$netDevice->setIpAddress($macAndIp[$deviceName]['ip']);
				$netDevice->setMacAddress($macAndIp[$deviceName]['mac']);
			}
			if (isset($chipsetAndDriver[$deviceName])){
				$netDevice->setChipset($chipsetAndDriver[$deviceName]['chipset']);
				$netDevice->setDriver($chipsetAndDriver[$deviceName]['driver']);
				$netDevice->setPhy($chipsetAndDriver[$deviceName]['phy']);
			}
			if (isset($devicesMode[$deviceName])){
				$netDevice->setMode($devicesMode[$deviceName]);
			}

			if (strpos($deviceInLine, self::CONNECTION) !== false) {
				$netDevice->setConnection(trim(str_replace(self::CONNECTION,'',$deviceInLine)));
				$devices[$netDevice->getDevice()]=$netDevice;
				$netDevice = new NetDevice();
			}
		}

		return $devices;
	}

	/**
	 * @param $devices
	 * @param $networkDevicesInfo
	 * @return array
	 * @throws Exception
	 */
	private function createDevicesInfo($devices, $networkDevicesInfo){

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
	 * @throws Exception
	 */
	private function getDeviceMode(){
		$deviceModeString = $this->runBashScript('iwconfig.sh');

		$deviceModeExplode = explode('wlan',$deviceModeString);
		$deviceModes = [];
		foreach ($deviceModeExplode as $deviceModeLine){
			if (!empty($deviceModeLine)){
				$deviceModes['wlan' . substr($deviceModeLine,0,1)] = trim(DevTools::getStringBetween($deviceModeLine,"Mode:"," "));
			}

		}
		return $deviceModes;
	}




}
