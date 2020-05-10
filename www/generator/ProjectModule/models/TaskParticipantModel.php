<?php

namespace App\Model;

use Nette;


class TaskParticipantModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'participantId' => '', 
	'taskId' => ''
    ];

    	 public function getParticipantId(){return $this->tableContent['participantId'];} 
	 public function setParticipantId($x){$this->tableContent['participantId']=$x;} 

	 public function getTaskId(){return $this->tableContent['taskId'];} 
	 public function setTaskId($x){$this->tableContent['taskId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idTaskParticipant');
		$this->setTableName('taskParticipant');
	}



}

