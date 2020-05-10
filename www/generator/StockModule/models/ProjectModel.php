<?php

namespace App\Model;

use Nette;


class ProjectModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'projectName' => '', 
	'projectAdmin' => '', 
	'createDate' => '', 
	'createLogin' => '', 
	'organisationId' => ''
    ];

    	 public function getProjectName(){return $this->tableContent['projectName'];} 
	 public function setProjectName($x){$this->tableContent['projectName']=$x;} 

	 public function getProjectAdmin(){return $this->tableContent['projectAdmin'];} 
	 public function setProjectAdmin($x){$this->tableContent['projectAdmin']=$x;} 

	 public function getCreateDate(){return $this->tableContent['createDate'];} 
	 public function setCreateDate($x){$this->tableContent['createDate']=$x;} 

	 public function getCreateLogin(){return $this->tableContent['createLogin'];} 
	 public function setCreateLogin($x){$this->tableContent['createLogin']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idProject');
		$this->setTableName('project');
	}



}

