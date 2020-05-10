<?php

namespace App\Model;

use Nette;


class WifiListModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'unixTime' => '', 
	'bssid' => '', 
        'signalStrength'=>null,
	'ssid' => '', 
	'longitude' => '', 
	'latitude' => '', 
	'gpsAccurancy' => null, 
	'apCapabilities' => null, 
	'channel' => null, 
	'frequency' => null
    ];

    	 public function getUnixTime(){return $this->tableContent['unixTime'];} 
	 public function setUnixTime($x){$this->tableContent['unixTime']=$x;} 

	 public function getBssid(){return $this->tableContent['bssid'];} 
	 public function setBssid($x){$this->tableContent['bssid']=$x;} 

	 public function getSsid(){return $this->tableContent['ssid'];} 
	 public function setSsid($x){$this->tableContent['ssid']=$x;} 
         
         public function getSignalStrength(){return $this->tableContent['signalStrength'];} 
	 public function setSignalStrength($x){$this->tableContent['signalStrength']=$x;} 

	 public function getLongitude(){return $this->tableContent['longitude'];} 
	 public function setLongitude($x){$this->tableContent['longitude']=$x;} 

	 public function getLatitude(){return $this->tableContent['latitude'];} 
	 public function setLatitude($x){$this->tableContent['latitude']=$x;} 

	 public function getGpsAccurancy(){return $this->tableContent['gpsAccurancy'];} 
	 public function setGpsAccurancy($x){$this->tableContent['gpsAccurancy']=$x;} 

	 public function getApCapabilities(){return $this->tableContent['apCapabilities'];} 
	 public function setApCapabilities($x){$this->tableContent['apCapabilities']=$x;} 

	 public function getChannel(){return $this->tableContent['channel'];} 
	 public function setChannel($x){$this->tableContent['channel']=$x;} 

	 public function getFrequency(){return $this->tableContent['frequency'];} 
	 public function setFrequency($x){$this->tableContent['frequency']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idWifiList');
		$this->setTableName('wifiList');
	}



}

