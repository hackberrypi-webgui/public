<?php

namespace App\WifiModule\Presenters;

use App\SharedPresenters\BasePresenter;


class WifiSettingsPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";

	private $shLibController;

	/**
	 * WifiSettingsPresenter constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->shLibController = new \ShLibController();
	}

	public function actionDefault()
	{
		parent::actionDefault();

//		$this->shLibController->getIpAndMac();
		$this->template->devices = $this->shLibController->getNetworkDevices();
		//$this->te
	}

	/**
	 * @param $wlan
	 * @param $state
	 * @throws \Exception
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
