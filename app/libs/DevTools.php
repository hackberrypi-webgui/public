<?php


class DevTools
{

	/**
	 * @param $string
	 * @return string|string[]|null
	 */
	public static function removeBinaryData($string){
		$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
		if (strlen($string) == 0) return null;
		return $result;
	}

	/**
	 * @param $dec
	 * @return array
	 */
	public static function DDtoDMS($dec)
	{
		$vars = explode(".", $dec);
		$deg = $vars[0];
		$tempma = "0." . $vars[1];

		$tempma = $tempma * 3600;
		$min = floor($tempma / 60);
		$sec = $tempma - ($min * 60);

		return array("deg" => $deg, "min" => $min, "sec" => $sec);
	}

	/**
	 * @param $points
	 * @return array
	 */
	public static function createPoints($points){
		$pointArray = [];
		foreach ($points as $item) {
			$lo = \DevTools::DDtoDMS($item->longitude);
			$la = \DevTools::DDtoDMS($item->latitude);

			$pointArray[$item->bssid . " " . $item->ssid] =
				[$la['deg'] . '°' . $la['min'] . "'" . $la['sec'] . '"N,' . $lo['deg'] . '°' . $lo['min'] . "'" . $lo['sec'] . '"E',
					$item->ssid . " " . $item->apCapabilities];
		}
		return $pointArray;
	}

	/**
	 * @return mixed
	 */
	public static function getRootFolder(){
		return $_SERVER['HTTP_HOST'] . str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
	}

}
