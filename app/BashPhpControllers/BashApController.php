<?php

class BashApController extends BaseBashController
{
	const SSID_DEFAULT = 'hackberry';
	const PASS_DEFAULT = 'toor1234';

	const INUSE = 'IN-USE:';
	const SSID = 'SSID:';
	const MODE = 'MODE:';
	const CHANNEL = 'CHAN:';
	const RATE = 'RATE:';
	const SIGNAL = 'SIGNAL:';
	const BARS = 'BARS:';
	const SECURITY = 'SECURITY:';


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
		return $this->createWifiApsList($wifiApLines);
	}

	/**
	 * @param $wifiApLines
	 * @return array
	 */
	private function createWifiApsList($wifiApLines){
		$wifiAps = [];
		$wifiAp = new \WifiAp();
		$ssid = [];

		foreach ($wifiApLines as $wifiApLine){

			if (strpos($wifiApLine, self::SSID) !== false) {
				$currentSsid = trim(str_replace(self::SSID,'',$wifiApLine));
				$wifiAp->setSsid($currentSsid);
			}

			if (strpos($wifiApLine, self::INUSE) !== false) {
				$wifiAp->setInUse(trim(str_replace(self::INUSE,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::MODE) !== false) {
				$wifiAp->setMode(trim(str_replace(self::MODE,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::CHANNEL) !== false) {
				$wifiAp->setChannel(trim(str_replace(self::CHANNEL,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::RATE) !== false) {
				$wifiAp->setRate(trim(str_replace(self::RATE,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::SIGNAL) !== false) {
				$wifiAp->setSignal(trim(str_replace(self::SIGNAL,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::BARS) !== false) {
				$wifiAp->setBars(trim(str_replace(self::BARS,'',$wifiApLine)));
			}

			if (strpos($wifiApLine, self::SECURITY) !== false) {
				$wifiAp->setSecurity(trim(str_replace(self::SECURITY,'',$wifiApLine)));

				if (in_array($currentSsid,$ssid)){
					$wifiAp = new \WifiAp();
					continue;
				}else{
					$ssid[] = $currentSsid;
					$wifiAps[]=$wifiAp;
					$wifiAp = new \WifiAp();
				}
			}
		}
		return $wifiAps;
	}

}
