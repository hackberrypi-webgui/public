<?php

namespace App\Forms;

use Nette;
use App\Model\WifiListModel;
use Nette\Application\UI\Form;
use App\Service\WifiListService;


class WifiListFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	private $wifiListService;

	public function __construct(
	    FormFactory $factory, WifiListService $wifiListService
    )
	{
		$this->factory = $factory;
		$this->wifiListService = $wifiListService;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSubmit)
	{

        $form = $this->factory->create();
        //$form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addHidden('idWifiList');

		
	 $form->addText('unixTime', 'unixTime')->setAttribute('placeholder','*Zadejte unixTime'); 
	 $form->addText('bssid', 'bssid')->setAttribute('placeholder','*Zadejte bssid'); 
	 $form->addText('ssid', 'ssid')->setAttribute('placeholder','*Zadejte ssid'); 
	 $form->addText('longitude', 'longitude')->setAttribute('placeholder','*Zadejte longitude'); 
	 $form->addText('latitude', 'latitude')->setAttribute('placeholder','*Zadejte latitude'); 
	 $form->addText('gpsAccurancy', 'gpsAccurancy')->setAttribute('placeholder','*Zadejte gpsAccurancy'); 
	 $form->addText('apCapabilities', 'apCapabilities')->setAttribute('placeholder','*Zadejte apCapabilities'); 
	 $form->addText('channel', 'channel')->setAttribute('placeholder','*Zadejte channel'); 
	 $form->addText('frequency', 'frequency')->setAttribute('placeholder','*Zadejte frequency'); 


		$form->addSubmit('send', 'Uložit')->setAttribute('idWifiList', 'save');

		$form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $values = $form->getValues();
            $rawValues = $form->getHttpData();
            $presenter = $form->getPresenter();

            if (isset($rawValues['idWifiList']) && $rawValues['idWifiList'] != null){
                $oldWifiList = $this->wifiListService->getBy($rawValues['idWifiList']);
            }else{
                $oldWifiList = [];
            }
            $tempWifiList = (array)$oldWifiList;

            foreach ($values as $key=>$item){ $tempWifiList[$key]=$item; }

            $newWifiList = new WifiListModel($tempWifiList);
            $newWifiList->setId($rawValues['idWifiList']);

            if (method_exists($newWifiList,'setCreated')){ $newWifiList->setCreated(date("Y-m-d H:i:s"));}
            if (method_exists($newWifiList,'setCreatedBy')){ $newWifiList->setCreatedBy($presenter->getUser()->getId());}

            $id = $this->wifiListService->save($newWifiList);

            $presenter->flashMessage("Uloženo", 'success');
            $presenter->redrawControl('flashMessage');

            if ($presenter->isAjax()) {
                $presenter->redrawControl('obsah');
                $presenter->redrawControl('editWifiList');

            } else {
                $presenter->redirect('this');
            }

			$onSubmit();
		};

		return $form;
	}

}
