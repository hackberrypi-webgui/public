<?php

namespace App\Service;

use Nette;


class _TABLENAMEUPPER_Service extends BaseService
{
	use Nette\SmartObject;

	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
	    parent::__construct($database);

		$this->database = $database;
		$this->setTableName('_TABLENAME_');
	}


}
