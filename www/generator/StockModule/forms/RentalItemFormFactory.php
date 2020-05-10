<?php

namespace App\Forms;

use Nette;
use App\Model\RentalItemModel;
use Nette\Application\UI\Form;
use App\Service\RentalItemService;


class RentalItemFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $rentalItemService;

	public function __construct(
	    FormFactory $factory, RentalItemService $rentalItemService
    )
	{
		$this->factory = $factory;
		$this->rentalItemService = $rentalItemService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('rentalItemId');

		
	 $form->addText('stockItemId', 'stockItemId')->setAttribute('placeholder','*Zadejte stockItemId'); 
	 $form->addText('createDate', 'createDate')->setAttribute('placeholder','*Zadejte createDate'); 
	 $form->addText('rentalId', 'rentalId')->setAttribute('placeholder','*Zadejte rentalId'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('rentalItemId', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['rentalItemId']) && $rawValues['rentalItemId'] != null){
                $oldRentalItem = $this->rentalItemService->getBy($rawValues['rentalItemId']);
            }else{
                $oldRentalItem = [];
            }
            $tempRentalItem = (array)$oldRentalItem;

            foreach ($values as $key=>$item){ $tempRentalItem[$key]=$item; }

            $newRentalItem = new RentalItemModel($tempRentalItem);
            $newRentalItem->setId($rawValues['rentalItemId']);

            if (method_exists($newRentalItem,'setCreated')){ $newRentalItem->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newRentalItem,'setCreatedBy')){ $newRentalItem->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->rentalItemService->save($newRentalItem);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editRentalItem');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
