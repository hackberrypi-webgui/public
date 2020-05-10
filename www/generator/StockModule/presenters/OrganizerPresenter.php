<?php
namespace App\StockModule\Presenters;

use App\Forms\OrganizerFormFactory;
use App\Service\OrganizerService;
use Nette;
use App\Model;


class OrganizerPresenter extends BasePresenter
{

    /** @persistent */
    public $lock = 0;

    /** @persistent */
    public $quickFlash = "";

    /** @var OrganizerService @inject */
    private $organizerService;

    /** @var OrganizerFormFactory @inject */
    public $organizerFormFactory;

    public function __construct(OrganizerService $organizerService)
    {
        $this->organizerService = $organizerService;

    }

    public function actionDefault()
    {
        parent::actionDefault(); // TODO: Change the autogenerated stub
    }

    public function startup()
    {
        parent::startup(); // TODO: Change the autogenerated stub
    }

    public function renderDefault()
	{
		$this->template->list = $this->organizerService->getList();
	}

    protected function createComponentOrganizerForm()
    {
        return $this->organizerFormFactory->create(function () {});
    }

    public function handleEditOrganizer($id = null){
        $this->template->editOrganizer = true;
        $this->template->idOrganizer = $id;

        if (($id != null)){

            $organizer = $this->organizerService->getBy($id);
            $organizerModel = new Model\OrganizerModel($organizer);

            $this['organizerForm']->setDefaults($organizer);

        }
        if ($this->isAjax()) {
            $this->redrawControl('editOrganizer');
        }else{
            $this->redirect(":Admin:Organizer:default");
        }
    }

    public function handleDeleteOrganizer($id){
        $organizerModel = new Model\OrganizerModel($this->organizerService->getBy($id));
        $this->organizerService->delete($organizerModel);
        if ($this->isAjax()) {
            $this->redrawControl('obsah');
        }else{
            $this->redirect(":Admin:Organizer:default");
        }
    }

}
