<?php

namespace App\Forms;

use Nette;
use App\Model\TaskParticipantModel;
use Nette\Application\UI\Form;
use App\Service\TaskParticipantService;


class TaskParticipantFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $taskParticipantService;

	public function __construct(
	    FormFactory $factory, TaskParticipantService $taskParticipantService
    )
	{
		$this->factory = $factory;
		$this->taskParticipantService = $taskParticipantService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idTaskParticipant');

		
	 $form->addText('participantId', 'participantId')->setAttribute('placeholder','*Zadejte participantId'); 
	 $form->addText('taskId', 'taskId')->setAttribute('placeholder','*Zadejte taskId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idTaskParticipant', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idTaskParticipant']) && $rawValues['idTaskParticipant'] != null){
                $oldTaskParticipant = $this->taskParticipantService->getBy($rawValues['idTaskParticipant']);
            }else{
                $oldTaskParticipant = [];
            }
            $tempTaskParticipant = (array)$oldTaskParticipant;

            foreach ($values as $key=>$item){ $tempTaskParticipant[$key]=$item; }

            $newTaskParticipant = new TaskParticipantModel($tempTaskParticipant);
            $newTaskParticipant->setId($rawValues['idTaskParticipant']);

            if (method_exists($newTaskParticipant,'setCreated')){ $newTaskParticipant->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newTaskParticipant,'setCreatedBy')){ $newTaskParticipant->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->taskParticipantService->save($newTaskParticipant);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editTaskParticipant');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
