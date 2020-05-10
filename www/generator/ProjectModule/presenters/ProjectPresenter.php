<?php
namespace App\ProjectModule\Presenters;

use App\Forms\ProjectFormFactory;
use App\Service\ProjectService;
use Nette;
use App\Model;


class ProjectPresenter extends BasePresenter
{

    /** @persistent */
    public $lock = 0;

    /** @persistent */
    public $quickFlash = "";

    /** @var ProjectService @inject */
    private $projectService;

    /** @var ProjectFormFactory @inject */
    public $projectFormFactory;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;

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
		$this->template->list = $this->projectService->getList();
	}

    protected function createComponentProjectForm()
    {
        return $this->projectFormFactory->create(function () {});
    }

    public function handleEditProject($id = null){
        $this->template->editProject = true;
        $this->template->idProject = $id;

        if (($id != null)){

            $project = $this->projectService->getBy($id);
            $projectModel = new Model\ProjectModel($project);

            $this['projectForm']->setDefaults($project);

        }
        if ($this->isAjax()) {
            $this->redrawControl('editProject');
        }else{
            $this->redirect(":Admin:Project:default");
        }
    }

    public function handleDeleteProject($id){
        $projectModel = new Model\ProjectModel($this->projectService->getBy($id));
        $this->projectService->delete($projectModel);
        if ($this->isAjax()) {
            $this->redrawControl('obsah');
        }else{
            $this->redirect(":Admin:Project:default");
        }
    }

}
