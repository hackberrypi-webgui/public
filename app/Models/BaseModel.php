<?php

namespace App\Model;

use Nette;


/**
 * Users management.
 */
Abstract class BaseModel
{
	use Nette\SmartObject;

    protected $tableName;
    protected $idName;
    protected $id = null;
    protected $tableContent;

    public function getTableName() { return $this->tableName; }
    public function setTableName($tableName) { $this->tableName = $tableName; }

    public function getIdName() { return $this->idName; }
    public function setIdName($idName) { $this->idName = $idName; }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getTableContent() {

        if ($this->id == null){
            return $this->tableContent;
        }else{
            if (is_array($this->tableContent)) {
                $tableContent = $this->tableContent;
            }else{
                $tableContent = [];
            }
            $array = array_merge($tableContent,[$this->idName=>$this->id]);
            return $array;
        }
    }
    public function setTableContent($keyValue){
        if (array_key_exists(key($keyValue),$this->tableContent)==true && key($keyValue) != $this->getIdName()){
            $this->tableContent[key($keyValue)]=$keyValue[key($keyValue)];
        }else{
            $this->setId($keyValue[key($keyValue)]);
        }
    }



    public function __construct($arr=null)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $item) {
                $this->setTableContent([$key => $item]);
            }
        }elseif($arr == null){
        }else{
             echo "Error: array needed! ".get_called_class();

        }
    }

}