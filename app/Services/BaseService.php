<?php

namespace App\Service;

use Nette;


/**
 * Users management.
 */
Abstract class BaseService
{
	use Nette\SmartObject;

	/** @var Nette\Database\Context */
	private $database;
	private $tableName;
        private $recentLoadData = [];
        
        public function getRecentLoadData(){ return $this->recentLoadData;}
        public function setRecentLoadData($x) {$this->recentLoadData = $x;}

	public function setTableName($par) {$this->tableName = $par;}
	public function getTableName() {return $this->tableName;}
        
        public function countData(){return count($this->getRecentLoadData());}


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

    public function save($object)
    {
        $arr = $object->getTableContent();        

        if ($object->getId() == null){
            try {
                $this->database->table($this->tableName)->insert($arr);
            } catch (Nette\Database\UniqueConstraintViolationException $e) {
                throw new \ErrorException($e);
            }
        }else{
            try {
                $count = $this->database->table($this->tableName)
                    ->where($object->getIdName(), $object->getId())
                    ->update($arr);
                return $object->getId();
            } catch (Nette\Database\UniqueConstraintViolationException $e) {
                throw new \ErrorException($e);
            }
        }

    }

    //TODO potunit
    public function getList($where=[],$offset=null,$perPage=null){  
        $selection = $this->database->table($this->tableName);
        
        if ($perPage != null) $selection->limit($perPage, $offset);
         
        foreach ($where as $dbKey => $queryKey) {

            if (strpos($queryKey, 'LIKE') !== false) {
                $like = explode('LIKE',$queryKey);
                $key = trim($like[0]);
                $value = trim($like[1]);
                $selection->where($key . ' LIKE ?', $value);
            }else{
                $selection->where([$dbKey=>$queryKey]);
            }            
        }

        $this->setRecentLoadData($selection);
        return $this->getRecentLoadData();
        
    }

    /**
     * @param $id
     * @return array
     */
    public function getBy($id){
	    $data = $this->database->table($this->tableName)->get($id);

        $array = [];
	    foreach ($data as $key=>$item){
	        $array[$key] = $item;
        }
        return $array;
    }

    public function delete($object){
        $count = $this->database->table($object->getTableName())
            ->where($object->getIdName(), $object->getId())
            ->delete();
        return $count;
    }

    public function getPairs($id=null,$column=null,$column2=null,$where=[]){

        if ($id==null || $column == null) return false;

        $query =  $this->database->table($this->tableName)->where($where);

        $array = [];
        foreach ($query as $item){
            if ($column2 != null){
                $array[$item->$id] = $item->$column.' '.$item->$column2;
            }else{
                $array[$item->$id] = $item->$column;
            }
        }

        return $array;
    }
}


