<?php

namespace App\Model;

use Nette;


class RentalModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'createDate' => '', 
	'rentalDate' => '', 
	'returnDate' => '', 
	'responsiblePerson' => '', 
	'rentalName' => '', 
	'rentalDescription' => '', 
	'eventId' => ''
    ];

    	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getRentalDate(){return $this->tableContent['rentalDate'];} 
	 public function setRentalDate($x){$this->tableContent['rentalDate']=$x;} 

	 public function getReturnDate(){return $this->tableContent['returnDate'];} 
	 public function setReturnDate($x){$this->tableContent['returnDate']=$x;} 

	 public function getResponsiblePerson(){return $this->tableContent['responsiblePerson'];} 
	 public function setResponsiblePerson($x){$this->tableContent['responsiblePerson']=$x;} 

	 public function getRentalName(){return $this->tableContent['rentalName'];} 
	 public function setRentalName($x){$this->tableContent['rentalName']=$x;} 

	 public function getRentalDescription(){return $this->tableContent['rentalDescription'];} 
	 public function setRentalDescription($x){$this->tableContent['rentalDescription']=$x;} 

	 public function getEventId(){return $this->tableContent['eventId'];} 
	 public function setEventId($x){$this->tableContent['eventId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idAsset');
		$this->setTableName('rental');
	}



}

