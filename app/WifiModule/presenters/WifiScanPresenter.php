<?php

namespace App\WifiModule\Presenters;

use App\Forms\WifiListFormFactory;
use App\Forms\UploadFileFormFactory;
use App\Service\WifiListService;
use App\SharedPresenters\BasePresenter;
use BashApController;
use BashMonitorModeController;
use BashNetworkController;
use Exception;
use Nette;
use App\Model;


class WifiScanPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";

	/** @var BashApController $bashApController */
	private $bashApController;
	/** @var BashNetworkController $bashNetworkController */
	private $bashNetworkController;
	/** @var BashMonitorModeController */
	private $bashMonitorModeController;

	protected $netDevices;


	/**
	 * WifiScanPresenter constructor.
	 * @throws Exception
	 */
	public function __construct()
	{
		parent::__construct();
		$this->bashApController = new BashApController();
		$this->bashNetworkController = new BashNetworkController();
		$this->bashMonitorModeController = new BashMonitorModeController();

		$this->netDevices = $this->bashNetworkController->getNetworkDevices();
	}


	/**
	 * @throws Exception
	 */
	public function actionDefault()
	{
		parent::actionDefault();
		$this->template->monitorModeOn = false;
		$devicesInMonitorMode = $this->bashNetworkController->getDevicesInMonitorMode();

		if (empty($devicesInMonitorMode)){
			$this->template->wifiAps = $this->bashApController->getWifiAp();
		}else{
			$this->template->monitorModeOn = true;
			$this->template->wifiAps = $this->bashMonitorModeController->getWifiAp(\DevTools::firstKeyInArray($devicesInMonitorMode));
			$this->template->tableHeaderCaptions = BashMonitorModeController::getNameArray();
		}
	}

	public function startup()
	{
		parent::startup();
	}


	/**
	 * @param bool $monitorModeOn
	 * @throws Exception
	 */
	public function handleRefreshList($monitorModeOn = false){
		if (!$monitorModeOn){
			$this->template->wifiAps = $this->bashApController->getWifiAp();
		}else{
			$devicesInMonitorMode = $this->bashNetworkController->getDevicesInMonitorMode();
			$this->template->monitorModeOn = true;
			$this->template->wifiAps = $this->bashMonitorModeController->getWifiAp(\DevTools::firstKeyInArray($devicesInMonitorMode));
			$this->template->tableHeaderCaptions = BashMonitorModeController::getNameArray();

		}
		$this->redrawControl('scanDeviceList');
	}

	/**
	 * @throws Nette\Application\AbortException
	 */
	public function handleWifiRestart(){
		$this->bashMonitorModeController->killProcess('airodump-ng');
		$this->bashMonitorModeController->clearCache();
		$this->redirect("this");
	}





}
