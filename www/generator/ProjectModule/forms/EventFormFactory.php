<?php

namespace App\Forms;

use Nette;
use App\Model\EventModel;
use Nette\Application\UI\Form;
use App\Service\EventService;


class EventFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $eventService;

	public function __construct(
	    FormFactory $factory, EventService $eventService
    )
	{
		$this->factory = $factory;
		$this->eventService = $eventService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idEvent');

		
	 $form->addText('eventName', 'eventName')->setAttribute('placeholder','*Zadejte eventName'); 
	 $form->addText('eventDate', 'eventDate')->setAttribute('placeholder','*Zadejte eventDate'); 
	 $form->addText('eventAdminUserId', 'eventAdminUserId')->setAttribute('placeholder','*Zadejte eventAdminUserId'); 
	 $form->addText('created', 'created')->setAttribute('placeholder','*Zadejte created'); 
	 $form->addText('createdByUserId', 'createdByUserId')->setAttribute('placeholder','*Zadejte createdByUserId'); 
	 $form->addText('mainEvent', 'mainEvent')->setAttribute('placeholder','*Zadejte mainEvent'); 
	 $form->addText('description', 'description')->setAttribute('placeholder','*Zadejte description'); 
	 $form->addText('projectId', 'projectId')->setAttribute('placeholder','*Zadejte projectId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idEvent', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idEvent']) && $rawValues['idEvent'] != null){
                $oldEvent = $this->eventService->getBy($rawValues['idEvent']);
            }else{
                $oldEvent = [];
            }
            $tempEvent = (array)$oldEvent;

            foreach ($values as $key=>$item){ $tempEvent[$key]=$item; }

            $newEvent = new EventModel($tempEvent);
            $newEvent->setId($rawValues['idEvent']);

            if (method_exists($newEvent,'setCreated')){ $newEvent->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newEvent,'setCreatedBy')){ $newEvent->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->eventService->save($newEvent);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editEvent');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
