<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

class FilterFormFactory {

    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;
    protected $form;
    protected $values;
    protected $fieldParameters = [];
    
    /** @var Nette\Http\Session */
    public $session;

    /** @var Nette\Http\SessionSection */
    public $sessionSection;
    
    public function getSessionValues(){return $this->sessionSection->values;}
    public function addFieldParameter($key,$item){$this->fieldParameters[$key]=$item;}
    
    public function getForm(){return $this->form;}
    public function setForm($x) {$this->form = $x;}
    
    public function __construct(FormFactory $factory, Nette\Http\Session $session) {
        $this->factory = $factory;
        $this->session = $session;
        $this->sessionSection = $session->getSection('filterSection'); 
        
        $this->setForm($this->factory->create());

    }
           

    public function addFilterField($name,$dbName,$params){
        $form = $this->getForm();
        $form->addText($dbName,$name);
        $this->addFieldParameter($dbName, $params);
    }
    
    public function addFilterTemplate($values){
        //TODO zde se budou přidávat funkce k poli s filtrem
        $newValues = [];
        foreach ((array)$values as $key=>$item){
            if (isset($this->fieldParameters[$key])){                
            $array_from_to = array (
                '#dbName' => $key,
                '#value' => $item
            );

            $query = str_replace(array_keys($array_from_to), $array_from_to, 
                    $this->parametersDictionary[$this->fieldParameters[$key]]);
            $newValues[] = $query;
            }
        }      
        return $newValues;
    }
    
    public function createWhere($values){
        //TODO zde se bude formátovat do tvaru potřebného k použití v query
        return $this->addFilterTemplate($values);        
    }
    
    /**
     * 
     * @return type
     */
    public function getWhere(){
        return $this->createWhere(
                $this->addFilterTemplate($this->sessionSection->values)
                );
    }
    
    /**
     * @return Form
     */
    public function create(callable $onSubmit) {
        $form = $this->getForm();
        $form->elementPrototype->addAttributes(array('class' => 'ajax'));
        $form->addSubmit('send', 'Filtrovat')->setAttribute("class","filterButton");

        $form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $presenter = $form->getPresenter();
            $userId = $presenter->getUser()->getId();
            $values = $form->getValues();
            $this->sessionSection->values = $values;
            
            $onSubmit();
        };

        return $form;
    }
    
    protected $parametersDictionary = [
        '%like%' => "#dbName LIKE %#value%",
        '%like' => "#dbName LIKE %#value",
        'like%' => "#dbName LIKE #value%"
        
    ];

}
