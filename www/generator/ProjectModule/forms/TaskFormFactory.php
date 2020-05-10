<?php

namespace App\Forms;

use Nette;
use App\Model\TaskModel;
use Nette\Application\UI\Form;
use App\Service\TaskService;


class TaskFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $taskService;

	public function __construct(
	    FormFactory $factory, TaskService $taskService
    )
	{
		$this->factory = $factory;
		$this->taskService = $taskService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idTask');

		
	 $form->addText('eventId', 'eventId')->setAttribute('placeholder','*Zadejte eventId'); 
	 $form->addText('finishDate', 'finishDate')->setAttribute('placeholder','*Zadejte finishDate'); 
	 $form->addText('taskName', 'taskName')->setAttribute('placeholder','*Zadejte taskName'); 
	 $form->addText('description', 'description')->setAttribute('placeholder','*Zadejte description'); 
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 
	 $form->addText('createdByUserId', 'createdByUserId')->setAttribute('placeholder','*Zadejte createdByUserId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idTask', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idTask']) && $rawValues['idTask'] != null){
                $oldTask = $this->taskService->getBy($rawValues['idTask']);
            }else{
                $oldTask = [];
            }
            $tempTask = (array)$oldTask;

            foreach ($values as $key=>$item){ $tempTask[$key]=$item; }

            $newTask = new TaskModel($tempTask);
            $newTask->setId($rawValues['idTask']);

            if (method_exists($newTask,'setCreated')){ $newTask->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newTask,'setCreatedBy')){ $newTask->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->taskService->save($newTask);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editTask');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
