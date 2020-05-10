<?php

namespace App\Model;

use Nette;


class EventModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'eventName' => '', 
	'eventDate' => '', 
	'eventAdminUserId' => '', 
	'created' => '', 
	'createdByUserId' => '', 
	'mainEvent' => '', 
	'description' => '', 
	'projectId' => ''
    ];

    	 public function getEventName(){return $this->tableContent['eventName'];} 
	 public function setEventName($x){$this->tableContent['eventName']=$x;} 

	 public function getEventDate(){return $this->tableContent['eventDate'];} 
	 public function setEventDate($x){$this->tableContent['eventDate']=$x;} 

	 public function getEventAdminUserId(){return $this->tableContent['eventAdminUserId'];} 
	 public function setEventAdminUserId($x){$this->tableContent['eventAdminUserId']=$x;} 

	 public function getCreated(){return $this->tableContent['created'];} 
	 public function setCreated($x){$this->tableContent['created']=$x;} 

	 public function getCreatedByUserId(){return $this->tableContent['createdByUserId'];} 
	 public function setCreatedByUserId($x){$this->tableContent['createdByUserId']=$x;} 

	 public function getMainEvent(){return $this->tableContent['mainEvent'];} 
	 public function setMainEvent($x){$this->tableContent['mainEvent']=$x;} 

	 public function getDescription(){return $this->tableContent['description'];} 
	 public function setDescription($x){$this->tableContent['description']=$x;} 

	 public function getProjectId(){return $this->tableContent['projectId'];} 
	 public function setProjectId($x){$this->tableContent['projectId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idEvent');
		$this->setTableName('event');
	}



}

