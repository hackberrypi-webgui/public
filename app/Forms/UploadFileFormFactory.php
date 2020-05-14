<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

class UploadFileFormFactory {

    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;
    private $file;
    private $path = null;
    /* stockImage*/
    private $type = null;
    private $name;
    private $referentId;

    public function setPath($path){ $this->path = $path; }
    public function getPath(){ return $this->path; }

    public function setType($type){ $this->type = $type; }
    public function getType(){ return $this->type; }

    public function getFile() {return $this->file; }
    public function getName() {return $this->name; }

    public function getReferentId() {return $this->referentId; }


    public function __construct(FormFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @return Form
     */
    public function create(callable $onSubmit) {
        $form = $this->factory->create();
        $form->addHidden('referentId');
        $form->addUpload('file', 'Soubor:', TRUE);
        $form->addSubmit('send', 'Nahrát soubor');

        $form->onSubmit[] = function (Form $form) use ($onSubmit) {

            $presenter = $form->getPresenter();
            $userId = $presenter->getUser()->getId();
            $values = $form->getValues();

            if ($this->getPath() == null){
                $path = 'userData/' . $userId.'/';
            }else{
                $path = $this->getPath();
            }

            $tmp = $values['file'];
            $file = ($tmp[0]);

            $file->move($path.$file->getName());
            $this->name = substr($file->getName(),0,-4);
            $this->file = $path. $file->getName();
            $this->referentId = $values['referentId'];

            $onSubmit();
        };

        return $form;
    }

}
