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
	/** @var WifiListService @inject */
	private $wifiListService;


	/**
	 * WifiListPresenter constructor.
	 * @param WifiListService $wifiListService
	 */
	public function __construct(WifiListService $wifiListService)
	{
		parent::__construct();
		$this->wifiListService = $wifiListService;
	}


	public function actionDefault()
	{
		parent::actionDefault();
	}

	public function startup()
	{
		parent::startup();
	}






}
