<?php

class BashMonitorModeController extends BaseBashController
{

	/**
	 * @param $wlan
	 * @return string|null
	 */
	public function setDeviceIntoMonitorMode($wlan){
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m monitor');
	}

	public function setDeviceIntoAutoMode($wlan){
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m auto');
	}

	public function setDeviceIntoManagedMode($wlan){
		return $this->runBashScript('set_monitor_mode.sh -w ' . $wlan . ' -m managed');
	}


}
