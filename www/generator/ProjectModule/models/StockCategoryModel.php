<?php

namespace App\Model;

use Nette;


class StockCategoryModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'name' => '', 
	'code' => '', 
	'parentId' => '', 
	'status' => '', 
	'organisationId' => ''
    ];

    	 public function getName(){return $this->tableContent['name'];} 
	 public function setName($x){$this->tableContent['name']=$x;} 

	 public function getCode(){return $this->tableContent['code'];} 
	 public function setCode($x){$this->tableContent['code']=$x;} 

	 public function getParentId(){return $this->tableContent['parentId'];} 
	 public function setParentId($x){$this->tableContent['parentId']=$x;} 

	 public function getStatus(){return $this->tableContent['status'];} 
	 public function setStatus($x){$this->tableContent['status']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('id');
		$this->setTableName('stockCategory');
	}



}

