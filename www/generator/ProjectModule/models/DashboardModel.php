<?php

namespace App\Model;

use Nette;


class DashboardModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'dashboardName' => '', 
	'organisation' => '', 
	'created' => '', 
	'createdBy' => '', 
	'note' => '', 
	'default' => ''
    ];

    	 public function getDashboardName(){return $this->tableContent['dashboardName'];} 
	 public function setDashboardName($x){$this->tableContent['dashboardName']=$x;} 

	 public function getOrganisation(){return $this->tableContent['organisation'];} 
	 public function setOrganisation($x){$this->tableContent['organisation']=$x;} 

	 public function getCreated(){return $this->tableContent['created'];} 
	 public function setCreated($x){$this->tableContent['created']=$x;} 

	 public function getCreatedBy(){return $this->tableContent['createdBy'];} 
	 public function setCreatedBy($x){$this->tableContent['createdBy']=$x;} 

	 public function getNote(){return $this->tableContent['note'];} 
	 public function setNote($x){$this->tableContent['note']=$x;} 

	 public function getDefault(){return $this->tableContent['default'];} 
	 public function setDefault($x){$this->tableContent['default']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idDashboard');
		$this->setTableName('dashboard');
	}



}

