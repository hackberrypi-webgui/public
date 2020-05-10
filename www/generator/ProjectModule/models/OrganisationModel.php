<?php

namespace App\Model;

use Nette;


class OrganisationModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'organisationName' => '', 
	'street' => '', 
	'city' => '', 
	'postCode' => '', 
	'telephone' => '', 
	'email' => '', 
	'bankAccount' => '', 
	'identificationNumber' => '', 
	'contribution' => '', 
	'contributionDate' => '', 
	'shared' => '', 
	'privateFacebook' => '', 
	'dropbox' => '', 
	'web' => '', 
	'facebook' => '', 
	'instagram' => '', 
	'youtube' => '', 
	'google' => '', 
	'note' => ''
    ];

    	 public function getOrganisationName(){return $this->tableContent['organisationName'];} 
	 public function setOrganisationName($x){$this->tableContent['organisationName']=$x;} 

	 public function getStreet(){return $this->tableContent['street'];} 
	 public function setStreet($x){$this->tableContent['street']=$x;} 

	 public function getCity(){return $this->tableContent['city'];} 
	 public function setCity($x){$this->tableContent['city']=$x;} 

	 public function getPostCode(){return $this->tableContent['postCode'];} 
	 public function setPostCode($x){$this->tableContent['postCode']=$x;} 

	 public function getTelephone(){return $this->tableContent['telephone'];} 
	 public function setTelephone($x){$this->tableContent['telephone']=$x;} 

	 public function getEmail(){return $this->tableContent['email'];} 
	 public function setEmail($x){$this->tableContent['email']=$x;} 

	 public function getBankAccount(){return $this->tableContent['bankAccount'];} 
	 public function setBankAccount($x){$this->tableContent['bankAccount']=$x;} 

	 public function getIdentificationNumber(){return $this->tableContent['identificationNumber'];} 
	 public function setIdentificationNumber($x){$this->tableContent['identificationNumber']=$x;} 

	 public function getContribution(){return $this->tableContent['contribution'];} 
	 public function setContribution($x){$this->tableContent['contribution']=$x;} 

	 public function getContributionDate(){return $this->tableContent['contributionDate'];} 
	 public function setContributionDate($x){$this->tableContent['contributionDate']=$x;} 

	 public function getShared(){return $this->tableContent['shared'];} 
	 public function setShared($x){$this->tableContent['shared']=$x;} 

	 public function getPrivateFacebook(){return $this->tableContent['privateFacebook'];} 
	 public function setPrivateFacebook($x){$this->tableContent['privateFacebook']=$x;} 

	 public function getDropbox(){return $this->tableContent['dropbox'];} 
	 public function setDropbox($x){$this->tableContent['dropbox']=$x;} 

	 public function getWeb(){return $this->tableContent['web'];} 
	 public function setWeb($x){$this->tableContent['web']=$x;} 

	 public function getFacebook(){return $this->tableContent['facebook'];} 
	 public function setFacebook($x){$this->tableContent['facebook']=$x;} 

	 public function getInstagram(){return $this->tableContent['instagram'];} 
	 public function setInstagram($x){$this->tableContent['instagram']=$x;} 

	 public function getYoutube(){return $this->tableContent['youtube'];} 
	 public function setYoutube($x){$this->tableContent['youtube']=$x;} 

	 public function getGoogle(){return $this->tableContent['google'];} 
	 public function setGoogle($x){$this->tableContent['google']=$x;} 

	 public function getNote(){return $this->tableContent['note'];} 
	 public function setNote($x){$this->tableContent['note']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idOrganisation');
		$this->setTableName('organisation');
	}



}

