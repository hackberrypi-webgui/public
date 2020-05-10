<?php

namespace App\Model;

use Nette;


class StockLocationModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'name' => '', 
	'organisationId' => ''
    ];

    	 public function getName(){return $this->tableContent['name'];} 
	 public function setName($x){$this->tableContent['name']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('id');
		$this->setTableName('stockLocation');
	}



}

