<?php

namespace App\Service;

use App\Model\WifiListModel;
use ErrorException;
use Nette;


class WifiListService extends BaseService
{
	use Nette\SmartObject;

	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
	    parent::__construct($database);

		$this->database = $database;
		$this->setTableName('wifiList');
	}

	/**
	 * @param $array
	 * @param $translatefunction
	 * @return WifiListModel
	 */
        public function translateArrayIntoModel($array,$translatefunction){
			$finalArray = [];
            if (method_exists($this,$translatefunction) == true){
                $nullEmptyArray = $this->nullEmptyValues($array);
                foreach ($nullEmptyArray as $key=>$item){                    
                    $finalArray[$this->$translatefunction($key)] = \DevTools::removeBinaryData($item);
                }
            }                        
            return new WifiListModel($finalArray);
        }

	/**
	 * @param $array
	 * @return array
	 */
        public function nullEmptyValues($array){
            $newArray = [];
            foreach ($array as $key=>$item){
                if (!empty($item)){
                    $newArray[$key] = $item;                    
                }else{
                    $newArray[$key] = null;
                }
            }
            return $newArray;            
        }

	/**
	 * @param null $key
	 * @return array|mixed
	 */
        public function wifiTrackerFieldName($key=null){               
            $names = [ 
                0 => 'unixTime',
                1 => 'bssid',
                2 => 'signalStrength',
                3 => 'ssid',
                4 => 'longitude',
                5 => 'latitude',
                6 => 'gpsAccurancy',
                7 => 'apCapabilities',
                8 => 'channel',
                9 => 'frequency'
            ];
            
            if ($key !== null){
                if (isset($names[$key])) return $names[$key];
            }
                                   
            return $names;
        }

	/**
	 * @param $bssid
	 * @return bool
	 */
        public function checkBssidExist($bssid){            
            $check = $this->getList(['bssid'=>$bssid])->count();            
            if ($check == 0) return true;
            return false;            
        }

	/**
	 * @param $uploadedFile
	 * @throws ErrorException
	 */
	public function checkUploadedFile($uploadedFile)
	{
		if ($uploadedFile != null) {
			$csv = array_map('str_getcsv', file($uploadedFile));
			foreach ($csv as $item) {
				$wifiListModel = ($this->translateArrayIntoModel($item, 'wifiTrackerFieldName'));
				if ($wifiListModel->getUnixTime() != 'Unix time') {
					if ($this->checkBssidExist($wifiListModel->getBssid()) == true) {
						$this->save($wifiListModel);
					}
				}
			}
		}
	}


}
