<?php

namespace App\Forms;

use Nette;
use App\Model\_TABLENAMEUPPER_Model;
use Nette\Application\UI\Form;
use App\Service\_TABLENAMEUPPER_Service;


class _TABLENAMEUPPER_FormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $_TABLENAME_Service;

	public function __construct(
	    FormFactory $factory, _TABLENAMEUPPER_Service $_TABLENAME_Service
    )
	{
		$this->factory = $factory;
		$this->_TABLENAME_Service = $_TABLENAME_Service;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('_PRIMARYKEY_');

		//INPUTS

		$form->addSubmit('send', 'Uložit')->setAttribute('_PRIMARYKEY_', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['_PRIMARYKEY_']) && $rawValues['_PRIMARYKEY_'] != null){
                $old_TABLENAMEUPPER_ = $this->_TABLENAME_Service->getBy($rawValues['_PRIMARYKEY_']);
            }else{
                $old_TABLENAMEUPPER_ = [];
            }
            $temp_TABLENAMEUPPER_ = (array)$old_TABLENAMEUPPER_;

            foreach ($values as $key=>$item){ $temp_TABLENAMEUPPER_[$key]=$item; }

            $new_TABLENAMEUPPER_ = new _TABLENAMEUPPER_Model($temp_TABLENAMEUPPER_);
            $new_TABLENAMEUPPER_->setId($rawValues['_PRIMARYKEY_']);

            if (method_exists($new_TABLENAMEUPPER_,'setCreated')){ $new_TABLENAMEUPPER_->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($new_TABLENAMEUPPER_,'setCreatedBy')){ $new_TABLENAMEUPPER_->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->_TABLENAME_Service->save($new_TABLENAMEUPPER_);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('edit_TABLENAMEUPPER_');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
