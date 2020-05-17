<?php

namespace App\WifiscanModule\Presenters;

use App\Forms\WifiListFormFactory;
use App\Forms\UploadFileFormFactory;
use App\Service\WifiListService;
use App\SharedPresenters\BasePresenter;
use Nette;
use App\Model;


class WifiListPresenter extends BasePresenter
{
	/** @persistent */
	public $lock = 0;
	/** @persistent */
	public $quickFlash = "";
	/** @var WifiListService @inject */
	private $wifiListService;
	/** @var WifiListFormFactory @inject */
	public $wifiListFormFactory;
	/** @var UploadFileFormFactory @inject */
	public $uploadFileFormFactory;

	protected $uploadedFile = null;
	protected $where = [];

	/** @persistent */
	public $pagPerPage = 8;

	/** @persistent */
	public $pagOffset = 0;


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
		$this->defineFilterField();
	}

	public function startup()
	{
		parent::startup();
	}


	public function renderDefault()
	{
		$this->wifiListService->getList($this->where);
		$visualPaginator = $this['visualPaginator'];
		$visualPaginator->setListPerPage([8, 24, 32, 64, 128]);
		$paginator = $visualPaginator->getPaginator();

		$paginator->itemsPerPage = $visualPaginator->getItemsPerPage();
		$paginator->itemCount = $this->wifiListService->countData();

		$this->pagOffset = $paginator->offset;
		$this->pagPerPage = $paginator->itemsPerPage;

		$this->wifiListService->getList($this->where, $paginator->offset, $paginator->itemsPerPage);

		if ($this->isAjax()) {
			$this->template->list = $this->wifiListService->getRecentLoadData();
			$this->redrawControl('obsah');
		} else {
			$this->template->list = $this->wifiListService->getRecentLoadData();
		}
		$this->template->where = $this->where;
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentWifiListForm()
	{
		return $this->wifiListFormFactory->create(function () {
		});
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentUploadFileForm()
	{
		return $this->uploadFileFormFactory->create(function () {
			$this->uploadedFile = $this->uploadFileFormFactory->getFile();
			try{
				$this->wifiListService->checkUploadedFile($this->uploadedFile);
				$this->flashMessage('Data imported successfully','info');
			}catch (\Exception $e){
				$this->flashMessage('Error occurred during import','error');
			}

			$this->redirect('this');
		});
	}

	/**
	 * @return mixed
	 */
	protected function createComponentFilterForm()
	{
		/** @var Nette\Forms\Form $form */
		$form = $this->filterFormFactory->getForm();
		$defaultValues = $this->filterFormFactory->getSessionValues();
		if (!empty($defaultValues)) $form->setDefaults($defaultValues);

		return $this->filterFormFactory->create(function () {
			$this->where = ($this->filterFormFactory->createWhere($this->filterFormFactory->getSessionValues()));
		});
	}

	private function defineFilterField()
	{
		$filter = $this->filterFormFactory;
		$filter->addFilterField('ssid', 'ssid', '%like%');
		$filter->addFilterField('bssid', 'bssid', '%like%');
		$filter->addFilterField('apCapabilities', 'apCapabilities', '%like%');
		$this->where = ($this->filterFormFactory->createWhere($this->filterFormFactory->getSessionValues()));
	}

	/**
	 * @param null $id
	 */
	public function actionEditWifiList($id = null)
	{
		$this->template->editWifiList = true;
		$this->template->idWifiList = $id;

		if (($id != null)) {
			$wifiList = $this->wifiListService->getBy($id);
			/** @var Nette\Forms\Form $wifiListForm */
			$wifiListForm = $this['wifiListForm'];
			$wifiListForm->setDefaults($wifiList);
		}
	}

	public function actionScanWifi($command1d){

	}

	/**
	 * @param $id
	 * @throws Nette\Application\AbortException
	 */
	public function handleDeleteWifiList($id)
	{
		$wifiListModel = new Model\WifiListModel($this->wifiListService->getBy($id));
		$this->wifiListService->delete($wifiListModel);
		if ($this->isAjax()) {
			$this->redrawControl('obsah');
		} else {
			$this->redirect(":Admin:WifiList:default");
		}
	}

	public function actionImportWifiList()
	{
	}

	/**
	 * @param null $where
	 */
	public function actionShowMap($where = null)
	{
		if ($where != null) $where = json_decode($where);

		$this->template->showMap = true;
		$this->wifiListService->getList($where, $this->pagOffset, $this->pagPerPage);
		$points = $this->wifiListService->getRecentLoadData();
		$pointArray = \DevTools::createPoints($points);

		$this->template->pointlist = json_encode($pointArray);
	}




}
