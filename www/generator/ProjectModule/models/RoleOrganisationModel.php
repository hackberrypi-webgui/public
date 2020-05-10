<?php

namespace App\Model;

use Nette;


class RoleOrganisationModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'userId' => '', 
	'organisationId' => '', 
	'roleId' => '', 
	'roleTypeId' => '', 
	'created' => '', 
	'createdBy' => ''
    ];

    	 public function getUserId(){return $this->tableContent['userId'];} 
	 public function setUserId($x){$this->tableContent['userId']=$x;} 

	 public function getOrganisationId(){return $this->tableContent['organisationId'];} 
	 public function setOrganisationId($x){$this->tableContent['organisationId']=$x;} 

	 public function getRoleId(){return $this->tableContent['roleId'];} 
	 public function setRoleId($x){$this->tableContent['roleId']=$x;} 

	 public function getRoleTypeId(){return $this->tableContent['roleTypeId'];} 
	 public function setRoleTypeId($x){$this->tableContent['roleTypeId']=$x;} 

	 public function getCreated(){return $this->tableContent['created'];} 
	 public function setCreated($x){$this->tableContent['created']=$x;} 

	 public function getCreatedBy(){return $this->tableContent['createdBy'];} 
	 public function setCreatedBy($x){$this->tableContent['createdBy']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idRole');
		$this->setTableName('roleOrganisation');
	}



}

