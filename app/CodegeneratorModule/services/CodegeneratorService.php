<?php

namespace App\CodegeneratorModule\Service;
use \Nette;
//use \App\Model;

/**
 * Users management.
 */
class CodegeneratorService {

    use Nette\SmartObject;

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /**
     * Vrací seznam sloupců
     * @param null $database
     * @param null $table
     * @return array|bool
     */
    public function getGettersAndSetters($database = null, $table = null){
        if ($database == null || $table == null) return false;

        $result = $this->database->query("
          SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` 
          WHERE `TABLE_SCHEMA`='$database' AND `TABLE_NAME`='$table' ")->fetchAll();

        $array = [];
        foreach ($result as $item){ $array[] = $item[0];}
        return $array;
    }

    /**
     * Vrací primární klíč
     * @param null $database
     * @param null $table
     * @return bool|Nette\Database\IRow|Nette\Database\Row
     */
    public function getPrimaryKey($database = null, $table = null){
        if ($database == null || $table == null) return false;

        $result = $this->database->query("
        SELECT k.column_name FROM information_schema.table_constraints t
        JOIN information_schema.key_column_usage k
        USING(constraint_name,table_schema,table_name)
        WHERE t.constraint_type='PRIMARY KEY' AND t.table_schema='$database' AND t.table_name='$table';
        ")->fetch();

        return $result['column_name'];

    }
    
    /**
     * vrací seznam všech tabulek v databázi
     * @param type $database
     * @return boolean
     */
    public function getAllTables($database = null){
        if ($database == null) return false;
        $result = $this->database->query("
        SELECT table_name FROM information_schema.tables 
        WHERE table_schema = '".$database."';
        ")->fetchPairs();

        return $result;
    }


}
