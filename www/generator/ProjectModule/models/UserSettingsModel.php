<?php

namespace App\Model;

use Nette;


class UserSettingsModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'userId' => '', 
	'dateFormat' => '', 
	'timeFormat' => '', 
	'defaultOrganisation' => '', 
	'defaultDashboard' => ''
    ];

    	 public function getUserId(){return $this->tableContent['userId'];} 
	 public function setUserId($x){$this->tableContent['userId']=$x;} 

	 public function getDateFormat(){return $this->tableContent['dateFormat'];} 
	 public function setDateFormat($x){$this->tableContent['dateFormat']=$x;} 

	 public function getTimeFormat(){return $this->tableContent['timeFormat'];} 
	 public function setTimeFormat($x){$this->tableContent['timeFormat']=$x;} 

	 public function getDefaultOrganisation(){return $this->tableContent['defaultOrganisation'];} 
	 public function setDefaultOrganisation($x){$this->tableContent['defaultOrganisation']=$x;} 

	 public function getDefaultDashboard(){return $this->tableContent['defaultDashboard'];} 
	 public function setDefaultDashboard($x){$this->tableContent['defaultDashboard']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idUserSet');
		$this->setTableName('userSettings');
	}



}

