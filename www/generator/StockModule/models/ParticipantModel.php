<?php

namespace App\Model;

use Nette;


class ParticipantModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'userId' => '', 
	'createDate' => '', 
	'eventId' => ''
    ];

    	 public function getUserId(){return $this->tableContent['userId'];} 
	 public function setUserId($x){$this->tableContent['userId']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getEventId(){return $this->tableContent['eventId'];} 
	 public function setEventId($x){$this->tableContent['eventId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idParticipant');
		$this->setTableName('participant');
	}



}

