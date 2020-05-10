<?php

namespace App\Model;

use Nette;


class StockItemModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'ic' => '', 
	'size' => '', 
	'weight' => '', 
	'price' => '', 
	'createdBy' => '', 
	'createdDate' => '', 
	'parent' => '', 
	'group' => '', 
	'description' => '', 
	'status' => '', 
	'location' => '', 
	'foto' => '', 
	'name' => '', 
	'amount' => '', 
	'color' => '', 
	'organisationId' => ''
    ];

    	 public function getIc(){return $this->tableContent['ic'];} 
	 public function setIc($x){$this->tableContent['ic']=$x;} 

	 public function getSize(){return $this->tableContent['size'];} 
	 public function setSize($x){$this->tableContent['size']=$x;} 

	 public function getWeight(){return $this->tableContent['weight'];} 
	 public function setWeight($x){$this->tableContent['weight']=$x;} 

	 public function getPrice(){return $this->tableContent['price'];} 
	 public function setPrice($x){$this->tableContent['price']=$x;} 

	 public function getCreatedBy(){return $this->tableContent['createdBy'];} 
	 public function setCreatedBy($x){$this->tableContent['createdBy']=$x;} 

	 public function getCreatedDate(){return $this->tableContent['createdDate'];} 
	 public function setCreatedDate($x){$this->tableContent['createdDate']=$x;} 

	 public function getParent(){return $this->tableContent['parent'];} 
	 public function setParent($x){$this->tableContent['parent']=$x;} 

	 public function getGroup(){return $this->tableContent['group'];} 
	 public function setGroup($x){$this->tableContent['group']=$x;} 

	 public function getDescription(){return $this->tableContent['description'];} 
	 public function setDescription($x){$this->tableContent['description']=$x;} 

	 public function getStatus(){return $this->tableContent['status'];} 
	 public function setStatus($x){$this->tableContent['status']=$x;} 

	 public function getLocation(){return $this->tableContent['location'];} 
	 public function setLocation($x){$this->tableContent['location']=$x;} 

	 public function getFoto(){return $this->tableContent['foto'];} 
	 public function setFoto($x){$this->tableContent['foto']=$x;} 

	 public function getName(){return $this->tableContent['name'];} 
	 public function setName($x){$this->tableContent['name']=$x;} 

	 public function getAmount(){return $this->tableContent['amount'];} 
	 public function setAmount($x){$this->tableContent['amount']=$x;} 

	 public function getColor(){return $this->tableContent['color'];} 
	 public function setColor($x){$this->tableContent['color']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('id');
		$this->setTableName('stockItem');
	}



}

