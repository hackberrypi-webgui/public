<?php

namespace App\Forms;

use Nette;
use App\Model\OrganizerModel;
use Nette\Application\UI\Form;
use App\Service\OrganizerService;


class OrganizerFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $organizerService;

	public function __construct(
	    FormFactory $factory, OrganizerService $organizerService
    )
	{
		$this->factory = $factory;
		$this->organizerService = $organizerService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idOrganizer');

		
	 $form->addText('userId', 'userId')->setAttribute('placeholder','*Zadejte userId'); 
	 $form->addText('eventId', 'eventId')->setAttribute('placeholder','*Zadejte eventId'); 
	 $form->addText('role', 'role')->setAttribute('placeholder','*Zadejte role'); 
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idOrganizer', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idOrganizer']) && $rawValues['idOrganizer'] != null){
                $oldOrganizer = $this->organizerService->getBy($rawValues['idOrganizer']);
            }else{
                $oldOrganizer = [];
            }
            $tempOrganizer = (array)$oldOrganizer;

            foreach ($values as $key=>$item){ $tempOrganizer[$key]=$item; }

            $newOrganizer = new OrganizerModel($tempOrganizer);
            $newOrganizer->setId($rawValues['idOrganizer']);

            if (method_exists($newOrganizer,'setCreated')){ $newOrganizer->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newOrganizer,'setCreatedBy')){ $newOrganizer->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->organizerService->save($newOrganizer);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editOrganizer');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
