<?php

namespace App\Model;

use Nette;


class RentalItemModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'stockItemId' => '', 
	'createDate' => '', 
	'rentalId' => ''
    ];

    	 public function getStockItemId(){return $this->tableContent['stockItemId'];} 
	 public function setStockItemId($x){$this->tableContent['stockItemId']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getRentalId(){return $this->tableContent['rentalId'];} 
	 public function setRentalId($x){$this->tableContent['rentalId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('rentalItemId');
		$this->setTableName('rentalItem');
	}



}

