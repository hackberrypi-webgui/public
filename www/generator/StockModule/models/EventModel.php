<?php

namespace App\Model;

use Nette;


class EventModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'eventName' => '', 
	'eventDate' => '', 
	'projectId' => '', 
	'eventAdmin' => '', 
	'createDate' => '', 
	'createLogin' => '', 
	'mainEvent' => ''
    ];

    	 public function getEventName(){return $this->tableContent['eventName'];} 
	 public function setEventName($x){$this->tableContent['eventName']=$x;} 

	 public function getEventDate(){return $this->tableContent['eventDate'];} 
	 public function setEventDate($x){$this->tableContent['eventDate']=$x;} 

	 public function getProjectId(){return $this->tableContent['projectId'];} 
	 public function setProjectId($x){$this->tableContent['projectId']=$x;} 

	 public function getEventAdmin(){return $this->tableContent['eventAdmin'];} 
	 public function setEventAdmin($x){$this->tableContent['eventAdmin']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getCreateLogin(){return $this->tableContent['createLogin'];} 
	 public function setCreateLogin($x){$this->tableContent['createLogin']=$x;} 

	 public function getMainEvent(){return $this->tableContent['mainEvent'];} 
	 public function setMainEvent($x){$this->tableContent['mainEvent']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idEvent');
		$this->setTableName('event');
	}



}

