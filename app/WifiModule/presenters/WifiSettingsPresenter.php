<?php

namespace App\WifiModule\Presenters;

use App\SharedPresenters\BasePresenter;
use Exception;


class WifiSettingsPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";

	//private $shLibController;

	private $bashNetworkController;

	/**
	 * WifiSettingsPresenter constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		//$this->shLibController = new \ShLibController();
		$this->bashNetworkController = new \BashNetworkController();
	}

	/**
	 * @throws Exception
	 */
	public function actionDefault()
	{
		parent::actionDefault();

		//$this->shLibController->getIpAndMac();
		//$this->shLibController->getWifiAp();

		$this->template->devices = $this->bashNetworkController->getNetworkDevices();
		//$this->te
	}

	/**
	 * @param $wlan
	 * @param $state
	 * @throws Exception
	 */
	public function handleSetWlanAsAp($wlan, $state){
		if ($state == 'disconnected'){
			$output = $this->shLibController->createWifiAp($wlan);
		}else{
			$output = $this->shLibController->deleteWifiAp($wlan);
		}
		$this->flashMessage($output,'info');
		$this->redirect("this");
	}

	public function startup()
	{
		parent::startup();
	}







}
