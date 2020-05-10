<?php
namespace App\StockModule\Presenters;

use App\Forms\TaskFormFactory;
use App\Service\TaskService;
use Nette;
use App\Model;


class TaskPresenter extends BasePresenter
{

    /** @persistent */
    public $lock = 0;

    /** @persistent */
    public $quickFlash = "";

    /** @var TaskService @inject */
    private $taskService;

    /** @var TaskFormFactory @inject */
    public $taskFormFactory;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;

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
		$this->template->list = $this->taskService->getList();
	}

    protected function createComponentTaskForm()
    {
        return $this->taskFormFactory->create(function () {});
    }

    public function handleEditTask($id = null){
        $this->template->editTask = true;
        $this->template->idTask = $id;

        if (($id != null)){

            $task = $this->taskService->getBy($id);
            $taskModel = new Model\TaskModel($task);

            $this['taskForm']->setDefaults($task);

        }
        if ($this->isAjax()) {
            $this->redrawControl('editTask');
        }else{
            $this->redirect(":Admin:Task:default");
        }
    }

    public function handleDeleteTask($id){
        $taskModel = new Model\TaskModel($this->taskService->getBy($id));
        $this->taskService->delete($taskModel);
        if ($this->isAjax()) {
            $this->redrawControl('obsah');
        }else{
            $this->redirect(":Admin:Task:default");
        }
    }

}
