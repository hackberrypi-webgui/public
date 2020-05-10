<?php

namespace App\Model;

use Nette;


class _TABLENAMEUPPER_Model extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    //TABLECONTENT
    ];

    //GETSET


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('_PRIMARYKEY_');
		$this->setTableName('_TABLENAME_');
	}



}

