<?php

namespace App\Model;

use Nette;


class ProjectModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'projectName' => '', 
	'projectAdminUserId' => '', 
	'created' => '', 
	'createdByUserId' => '', 
	'organisationId' => ''
    ];

    	 public function getProjectName(){return $this->tableContent['projectName'];} 
	 public function setProjectName($x){$this->tableContent['projectName']=$x;} 

	 public function getProjectAdminUserId(){return $this->tableContent['projectAdminUserId'];} 
	 public function setProjectAdminUserId($x){$this->tableContent['projectAdminUserId']=$x;} 

	 public function getCreated(){return $this->tableContent['created'];} 
	 public function setCreated($x){$this->tableContent['created']=$x;} 

	 public function getCreatedByUserId(){return $this->tableContent['createdByUserId'];} 
	 public function setCreatedByUserId($x){$this->tableContent['createdByUserId']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idProject');
		$this->setTableName('project');
	}



}

