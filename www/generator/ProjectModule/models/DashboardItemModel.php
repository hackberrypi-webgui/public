<?php

namespace App\Model;

use Nette;


class DashboardItemModel extends BaseModel
{
	use Nette\SmartObject;

    protected $tableContent = [
    	'dashboardItemName' => '', 
	'dashboardItemContent' => '', 
	'dashboardItemLink' => '', 
	'dashboardItemCreated' => '', 
	'dashboardItemCreatedBy' => '', 
	'dashboardItemType' => '', 
	'dashboardId' => ''
    ];

    	 public function getDashboardItemName(){return $this->tableContent['dashboardItemName'];} 
	 public function setDashboardItemName($x){$this->tableContent['dashboardItemName']=$x;} 

	 public function getDashboardItemContent(){return $this->tableContent['dashboardItemContent'];} 
	 public function setDashboardItemContent($x){$this->tableContent['dashboardItemContent']=$x;} 

	 public function getDashboardItemLink(){return $this->tableContent['dashboardItemLink'];} 
	 public function setDashboardItemLink($x){$this->tableContent['dashboardItemLink']=$x;} 

	 public function getDashboardItemCreated(){return $this->tableContent['dashboardItemCreated'];} 
	 public function setDashboardItemCreated($x){$this->tableContent['dashboardItemCreated']=$x;} 

	 public function getDashboardItemCreatedBy(){return $this->tableContent['dashboardItemCreatedBy'];} 
	 public function setDashboardItemCreatedBy($x){$this->tableContent['dashboardItemCreatedBy']=$x;} 

	 public function getDashboardItemType(){return $this->tableContent['dashboardItemType'];} 
	 public function setDashboardItemType($x){$this->tableContent['dashboardItemType']=$x;} 

	 public function getDashboardId(){return $this->tableContent['dashboardId'];} 
	 public function setDashboardId($x){$this->tableContent['dashboardId']=$x;}


	public function __construct($arr = null)
	{
	    parent::__construct($arr);

		$this->setIdName('idDashboardItem');
		$this->setTableName('dashboardItem');
	}



}

