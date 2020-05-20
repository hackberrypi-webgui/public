<?php

namespace App\WifiModule\Presenters;

use App\Forms\WifiListFormFactory;
use App\Forms\UploadFileFormFactory;
use App\Service\WifiListService;
use App\SharedPresenters\BasePresenter;
use Nette;
use App\Model;


class WifiScanPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";

	private $shLibController;


	/**
	 * WifiScanPresenter constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->shLibController = new \ShLibController();
	}


	public function actionDefault()
	{
		parent::actionDefault();
		//$this->shLibController->getWifiAp();

		$this->template->wifiAps = $this->shLibController->getWifiAp();;
	}

	public function startup()
	{
		parent::startup();
	}






}
