<?php

namespace App\WifiModule\Presenters;

use App\Forms\WifiListFormFactory;
use App\Forms\UploadFileFormFactory;
use App\Service\WifiListService;
use App\SharedPresenters\BasePresenter;
use BashApController;
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

		$this->netDevices = $this->bashNetworkController->getNetworkDevices();
	}


	public function actionDefault()
	{
		parent::actionDefault();
		$this->template->monitorModeOn = false;

		if (empty($this->bashNetworkController->getDevicesInMonitorMode())){
			$this->template->wifiAps = $this->bashApController->getWifiAp();;
		}else{
			$this->template->monitorModeOn = true;
			$this->template->wifiAps = [new \WifiAp()];



		}

	}

	public function startup()
	{
		parent::startup();
	}






}
