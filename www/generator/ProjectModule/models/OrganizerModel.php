<?php

namespace App\Model;

use Nette;


class OrganizerModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'userId' => '', 
	'eventId' => '', 
	'role' => '', 
	'createDate' => ''
    ];

    	 public function getUserId(){return $this->tableContent['userId'];} 
	 public function setUserId($x){$this->tableContent['userId']=$x;} 

	 public function getEventId(){return $this->tableContent['eventId'];} 
	 public function setEventId($x){$this->tableContent['eventId']=$x;} 

	 public function getRole(){return $this->tableContent['role'];} 
	 public function setRole($x){$this->tableContent['role']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idOrganizer');
		$this->setTableName('organizer');
	}



}

