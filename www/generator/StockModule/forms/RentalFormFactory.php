<?php

namespace App\Forms;

use Nette;
use App\Model\RentalModel;
use Nette\Application\UI\Form;
use App\Service\RentalService;


class RentalFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $rentalService;

	public function __construct(
	    FormFactory $factory, RentalService $rentalService
    )
	{
		$this->factory = $factory;
		$this->rentalService = $rentalService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idAsset');

		
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 
	 $form->addText('rentalDate', 'rentalDate')->setAttribute('placeholder','*Zadejte rentalDate'); 
	 $form->addText('returnDate', 'returnDate')->setAttribute('placeholder','*Zadejte returnDate'); 
	 $form->addText('responsiblePerson', 'responsiblePerson')->setAttribute('placeholder','*Zadejte responsiblePerson'); 
	 $form->addText('rentalName', 'rentalName')->setAttribute('placeholder','*Zadejte rentalName'); 
	 $form->addText('rentalDescription', 'rentalDescription')->setAttribute('placeholder','*Zadejte rentalDescription'); 
	 $form->addText('eventId', 'eventId')->setAttribute('placeholder','*Zadejte eventId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idAsset', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idAsset']) && $rawValues['idAsset'] != null){
                $oldRental = $this->rentalService->getBy($rawValues['idAsset']);
            }else{
                $oldRental = [];
            }
            $tempRental = (array)$oldRental;

            foreach ($values as $key=>$item){ $tempRental[$key]=$item; }

            $newRental = new RentalModel($tempRental);
            $newRental->setId($rawValues['idAsset']);

            if (method_exists($newRental,'setCreated')){ $newRental->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newRental,'setCreatedBy')){ $newRental->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->rentalService->save($newRental);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editRental');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
