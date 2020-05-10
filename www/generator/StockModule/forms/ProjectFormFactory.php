<?php

namespace App\Forms;

use Nette;
use App\Model\ProjectModel;
use Nette\Application\UI\Form;
use App\Service\ProjectService;


class ProjectFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $projectService;

	public function __construct(
	    FormFactory $factory, ProjectService $projectService
    )
	{
		$this->factory = $factory;
		$this->projectService = $projectService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idProject');

		
	 $form->addText('projectName', 'projectName')->setAttribute('placeholder','*Zadejte projectName'); 
	 $form->addText('projectAdmin', 'projectAdmin')->setAttribute('placeholder','*Zadejte projectAdmin'); 
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 
	 $form->addText('createLogin', 'createLogin')->setAttribute('placeholder','*Zadejte createLogin'); 
	 $form->addText('organisationId', 'organisationId')->setAttribute('placeholder','*Zadejte organisationId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idProject', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idProject']) && $rawValues['idProject'] != null){
                $oldProject = $this->projectService->getBy($rawValues['idProject']);
            }else{
                $oldProject = [];
            }
            $tempProject = (array)$oldProject;

            foreach ($values as $key=>$item){ $tempProject[$key]=$item; }

            $newProject = new ProjectModel($tempProject);
            $newProject->setId($rawValues['idProject']);

            if (method_exists($newProject,'setCreated')){ $newProject->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newProject,'setCreatedBy')){ $newProject->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->projectService->save($newProject);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editProject');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
