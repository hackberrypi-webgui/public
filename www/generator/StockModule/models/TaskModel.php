<?php

namespace App\Model;

use Nette;


class TaskModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'eventId' => '', 
	'finishDate' => '', 
	'taskName' => '', 
	'description' => '', 
	'createDate' => '', 
	'createLogin' => ''
    ];

    	 public function getEventId(){return $this->tableContent['eventId'];} 
	 public function setEventId($x){$this->tableContent['eventId']=$x;} 

	 public function getFinishDate(){return $this->tableContent['finishDate'];} 
	 public function setFinishDate($x){$this->tableContent['finishDate']=$x;} 

	 public function getTaskName(){return $this->tableContent['taskName'];} 
	 public function setTaskName($x){$this->tableContent['taskName']=$x;} 

	 public function getDescription(){return $this->tableContent['description'];} 
	 public function setDescription($x){$this->tableContent['description']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getCreateLogin(){return $this->tableContent['createLogin'];} 
	 public function setCreateLogin($x){$this->tableContent['createLogin']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idTask');
		$this->setTableName('task');
	}



}

