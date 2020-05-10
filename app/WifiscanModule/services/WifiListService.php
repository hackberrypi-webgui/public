<?php

namespace App\Service;

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
         * 
         * @param type $array
         * @param type $translatefunction
         * @return \App\Model\WifiListModel
         */
        public function translateArrayIntoModel($array,$translatefunction){
            if (method_exists($this,$translatefunction) == true){
                $finalArray = [];
                $nullEmptyArray = $this->nullEmptyValues($array);
                foreach ($nullEmptyArray as $key=>$item){                    
                    $finalArray[$this->$translatefunction($key)] = $item;
                }
            }                        
            return new \App\Model\WifiListModel($finalArray);
        }
        
        /**
         * 
         * @param type $array
         * @return type
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
         * 
         * @param type $trackerName
         * @param type $dbColumnName
         * @return array
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
         * 
         * @param type $bssid
         * @return boolean
         */
        public function checkBssidExist($bssid){            
            $check = $this->getList(['bssid'=>$bssid])->count();            
            if ($check == 0) return true;
            return false;            
        }


}
