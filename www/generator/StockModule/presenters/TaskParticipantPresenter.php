<?php
namespace App\StockModule\Presenters;

use App\Forms\TaskParticipantFormFactory;
use App\Service\TaskParticipantService;
use Nette;
use App\Model;


class TaskParticipantPresenter extends BasePresenter
{

    /** @persistent */
    public $lock = 0;

    /** @persistent */
    public $quickFlash = "";

    /** @var TaskParticipantService @inject */
    private $taskParticipantService;

    /** @var TaskParticipantFormFactory @inject */
    public $taskParticipantFormFactory;

    public function __construct(TaskParticipantService $taskParticipantService)
    {
        $this->taskParticipantService = $taskParticipantService;

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
		$this->template->list = $this->taskParticipantService->getList();
	}

    protected function createComponentTaskParticipantForm()
    {
        return $this->taskParticipantFormFactory->create(function () {});
    }

    public function handleEditTaskParticipant($id = null){
        $this->template->editTaskParticipant = true;
        $this->template->idTaskParticipant = $id;

        if (($id != null)){

            $taskParticipant = $this->taskParticipantService->getBy($id);
            $taskParticipantModel = new Model\TaskParticipantModel($taskParticipant);

            $this['taskParticipantForm']->setDefaults($taskParticipant);

        }
        if ($this->isAjax()) {
            $this->redrawControl('editTaskParticipant');
        }else{
            $this->redirect(":Admin:TaskParticipant:default");
        }
    }

    public function handleDeleteTaskParticipant($id){
        $taskParticipantModel = new Model\TaskParticipantModel($this->taskParticipantService->getBy($id));
        $this->taskParticipantService->delete($taskParticipantModel);
        if ($this->isAjax()) {
            $this->redrawControl('obsah');
        }else{
            $this->redirect(":Admin:TaskParticipant:default");
        }
    }

}
