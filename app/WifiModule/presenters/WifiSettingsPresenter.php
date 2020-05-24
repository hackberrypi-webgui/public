<?php

namespace App\WifiModule\Presenters;

use App\SharedPresenters\BasePresenter;
use Exception;
use NetDevice;
use Nette\Application\AbortException;


class WifiSettingsPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";

	private $bashNetworkController;
	private $bashApController;
	private $bashMonitorModeController;

	protected $netDevices;

	/**
	 * WifiSettingsPresenter constructor.
	 * @throws Exception
	 */
	public function __construct()
	{
		parent::__construct();
		$this->bashNetworkController = new \BashNetworkController();
		$this->bashApController = new \BashApController();
		$this->bashMonitorModeController = new \BashMonitorModeController();

		$this->netDevices = $this->bashNetworkController->getNetworkDevices();
	}

	/**
	 * @throws Exception
	 */
	public function actionDefault()
	{
		parent::actionDefault();

//		$wlan='wlan2';
//		print_r($this->bashMonitorModeController->setDeviceIntoMonitorMode($wlan));
//		exit();

		$this->template->devices = $this->netDevices;

	}

	/**
	 * @param $wlan
	 * @throws AbortException
	 * @throws Exception
	 */
	public function handleSetWlanAsAp($wlan){
		/** @var NetDevice $netDevice */
		$netDevice = $this->netDevices[$wlan];

		if ($netDevice->getState() == 'disconnected'){
			$this->bashApController->deleteWifiAp($netDevice->getDevice());
			$output = $this->bashApController->createWifiAp($netDevice->getDevice());
		}else{
			$output = $this->bashApController->deleteWifiAp($netDevice->getDevice());
		}
		$this->flashMessage($output,'info');
		$this->redirect("this");
	}

	/**
	 * @param $wlan
	 * @throws AbortException
	 * @throws Exception
	 */
	public function handleSetWlanIntoMonitorMode($wlan){
		/** @var NetDevice $netDevice */
		$netDevice = $this->netDevices[$wlan];
		$output = 'Device ' . $wlan . ' successfully set';
		$fm='info';

		if ($netDevice->getState()  == 'connected'){
			$output = 'Active connection exists! Please turn off the connection to apply monitor mode.';
			$fm='error';
		}else{
			if ($netDevice->getMode() == 'Monitor'){
				$this->bashMonitorModeController->setDeviceIntoManagedMode($netDevice->getDevice());
			}else{
				$this->bashMonitorModeController->setDeviceIntoMonitorMode($netDevice->getDevice());

				$this->netDevices = $this->bashNetworkController->getNetworkDevices();
				$netDevice = $this->netDevices[$wlan];

				if ($netDevice->getMode() != 'Monitor'){
					$output = 'Device can not be set to monitor mode';
					$fm = 'error';
				}
			}
		}

		$this->flashMessage($output,$fm);
		$this->redirect("this");
	}

	public function startup()
	{
		parent::startup();
	}







}
