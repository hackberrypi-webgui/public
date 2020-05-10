<?php

namespace App\Forms;

use Nette;
use App\Model\ParticipantModel;
use Nette\Application\UI\Form;
use App\Service\ParticipantService;


class ParticipantFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $participantService;

	public function __construct(
	    FormFactory $factory, ParticipantService $participantService
    )
	{
		$this->factory = $factory;
		$this->participantService = $participantService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idParticipant');

		
	 $form->addText('userId', 'userId')->setAttribute('placeholder','*Zadejte userId'); 
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 
	 $form->addText('eventId', 'eventId')->setAttribute('placeholder','*Zadejte eventId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idParticipant', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idParticipant']) && $rawValues['idParticipant'] != null){
                $oldParticipant = $this->participantService->getBy($rawValues['idParticipant']);
            }else{
                $oldParticipant = [];
            }
            $tempParticipant = (array)$oldParticipant;

            foreach ($values as $key=>$item){ $tempParticipant[$key]=$item; }

            $newParticipant = new ParticipantModel($tempParticipant);
            $newParticipant->setId($rawValues['idParticipant']);

            if (method_exists($newParticipant,'setCreated')){ $newParticipant->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newParticipant,'setCreatedBy')){ $newParticipant->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->participantService->save($newParticipant);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editParticipant');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
