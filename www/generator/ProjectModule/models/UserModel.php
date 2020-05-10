<?php

namespace App\Model;

use Nette;


class UserModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'name' => '', 
	'surname' => '', 
	'username' => '', 
	'password' => '', 
	'note' => '', 
	'photo' => '', 
	'email' => '', 
	'role' => '', 
	'phone' => ''
    ];

    	 public function getName(){return $this->tableContent['name'];} 
	 public function setName($x){$this->tableContent['name']=$x;} 

	 public function getSurname(){return $this->tableContent['surname'];} 
	 public function setSurname($x){$this->tableContent['surname']=$x;} 

	 public function getUsername(){return $this->tableContent['username'];} 
	 public function setUsername($x){$this->tableContent['username']=$x;} 

	 public function getPassword(){return $this->tableContent['password'];} 
	 public function setPassword($x){$this->tableContent['password']=$x;} 

	 public function getNote(){return $this->tableContent['note'];} 
	 public function setNote($x){$this->tableContent['note']=$x;} 

	 public function getPhoto(){return $this->tableContent['photo'];} 
	 public function setPhoto($x){$this->tableContent['photo']=$x;} 

	 public function getEmail(){return $this->tableContent['email'];} 
	 public function setEmail($x){$this->tableContent['email']=$x;} 

	 public function getRole(){return $this->tableContent['role'];} 
	 public function setRole($x){$this->tableContent['role']=$x;} 

	 public function getPhone(){return $this->tableContent['phone'];} 
	 public function setPhone($x){$this->tableContent['phone']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idUser');
		$this->setTableName('user');
	}



}

