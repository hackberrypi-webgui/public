<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

abstract class BaseForm{
    use Nette\SmartObject;

    protected $organisationId;
    public function setOrganisationId($organisationId) {$this->organisationId = $organisationId;}
    public function getOrganisationId(){return $this->organisationId;}



}