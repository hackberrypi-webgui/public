<?php
namespace App\CodegeneratorModule\Presenters;

use App\CodegeneratorModule\Service\CodegeneratorService;
use Nette;
use App\Model;
use App\Forms;


class HomepagePresenter extends \App\SharedPresenters\BasePresenter
{

    /* @var CodegeneratorService @inject*/
    protected $codegeneratorService;

    public $outputDir = "generator/";
    public $filePath = __DIR__."/../preset/";

    public $settings = [
            'database'      => 'hacking',
            'moduleName'    => 'WifiScanModule',            
            //'tables'        => ['project','event','organizer','participant','task','taskParticipant'],
            'tables'        => ['wifiList'],
            'moduleContent' => ['model','form','template','presenter','service'],
            //'moduleContent' => ['model']            
            //'moduleContent' => ['template']
        ];


    public function __construct(CodegeneratorService $codegeneratorService)
    {
        $this->codegeneratorService = $codegeneratorService;
        $settings = $this->settings;
        if (!file_exists($this->outputDir.$settings['moduleName'])) mkdir($this->outputDir.$settings['moduleName']);
        /*
         echo "Generator ...";
         exit();
         //*/
        
        
        if (!isset($settings['tables'])){
            $tableList = ($this->codegeneratorService->getAllTables($settings['database']));            
        }else{
            $tableList = $settings['tables'];
        }

        foreach ($tableList as $tableName){
            $primaryKey     = $this->codegeneratorService->getPrimaryKey($settings['database'],$tableName);
            $tableColumns   = $this->codegeneratorService->getGettersAndSetters($settings['database'],$tableName);

            if (in_array('model',$settings['moduleContent'])) {
                echo "<pre>";
                print_r($this->makeModel($primaryKey, $tableName, $tableColumns));
                echo "</pre>";
            }
            if (in_array('form',$settings['moduleContent'])){
                echo "<pre>";
                print_r($this->makeForm($primaryKey, $tableName, $tableColumns));
                echo "</pre>";
            }
            if (in_array('service',$settings['moduleContent'])){
                echo "<pre>";
                print_r($this->makeService($tableName));
                echo "</pre>";
            }
            if (in_array('presenter',$settings['moduleContent'])){
                echo "<pre>";
                print_r($this->makePresenter($tableName));
                echo "</pre>";
            }
            if (in_array('template',$settings['moduleContent'])){
                echo "<pre>";
                print_r($this->makeTemplate($primaryKey, $tableName, $tableColumns));
                echo "</pre>";
            }

        }

        echo "<pre>";
        print_r($settings);
        echo "</pre>";
        exit();

    }

    private function makeTemplate($primaryKey, $tableName, $tableColumns){
        $settings = $this->settings;
        $fileName = $this->filePath."default.latte";
        $file = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        $file = str_replace("_PRIMARYKEY_",$primaryKey,$file);
        $file = str_replace("_TABLENAME_",$tableName,$file);
        $file = str_replace("_TABLENAMEUPPER_",ucfirst($tableName),$file);

        if (!file_exists($this->outputDir.$this->settings['moduleName'].'/templates/')){
            mkdir($this->outputDir.$this->settings['moduleName'].'/templates/');
        }

        $thead = "\n"."<th>Actions</th>";
        $rowlist = "\n";
        $rowedit = "\n";
        foreach ($tableColumns as $column){
            if ($column != $primaryKey){
                $thead .= "\n"."<th>{$column}</th>";
                $rowlist .= "\n"."<td>{\$item->$column}</td>";
                $rowedit .= "\n"."<tr><td class=\"required\">{label $column /}{input $column}</td></tr>";
            }
        }

        $file = str_replace("_THEAD_",$thead,$file);
        $file = str_replace("_ROWLIST_",$rowlist,$file);
        $file = str_replace("_ROWEDIT_",$rowedit,$file);

        $this->createFile($file,"default.latte",
            $this->outputDir.$this->settings['moduleName'].'/templates/'.ucfirst($tableName)."/");
        return $file;
    }

    private function makePresenter($tableName){
        $settings = $this->settings;
        $fileName = $this->filePath."presenter.php";
        $file = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        $file = str_replace("_TABLENAME_",$tableName,$file);
        $file = str_replace("_TABLENAMEUPPER_",ucfirst($tableName),$file);
        $file = str_replace("_MODULENAME_",ucfirst($settings['moduleName']),$file);

        $this->createFile($file,ucfirst($tableName."Presenter.php"),$this->outputDir.$this->settings['moduleName'].'/presenters');
        return $file;
    }

    /**
     * @return bool|string
     */
    private function makeModel($primaryKey, $tableName, $tableColumns){
        $settings = $this->settings;
        $fileName = $this->filePath."model.php";
        $file = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        $tableContent = '';
        $getSet = '';

        foreach ($tableColumns as $column){
            if ($column != $primaryKey){
                $tableContent .= "\t'".$column."' => '', \n";
                $getSet .= "\t public function get".ucfirst($column)."(){return \$this->tableContent['$column'];} \n";
                $getSet .= "\t public function set".ucfirst($column)."(\$x){\$this->tableContent['$column']=\$x;} \n\n";
            }
        }
        $file = str_replace("_PRIMARYKEY_",$primaryKey,$file);
        $file = str_replace("_TABLENAME_",$tableName,$file);
        $file = str_replace("_TABLENAMEUPPER_",ucfirst($tableName),$file);
        $file = str_replace("//TABLECONTENT",substr($tableContent,0,-3),$file);
        $file = str_replace("//GETSET",substr($getSet,0,-3),$file);

        $this->createFile($file,ucfirst($tableName."Model.php"),$this->outputDir.$this->settings['moduleName'].'/models');
        return $file;
    }

    /**
     * @param $tableName
     * @return bool|mixed|string
     */
    private function makeService($tableName){
        $settings = $this->settings;
        $fileName = $this->filePath."service.php";
        $file = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        $file = str_replace("_TABLENAME_",$tableName,$file);
        $file = str_replace("_TABLENAMEUPPER_",ucfirst($tableName),$file);

        $this->createFile($file,ucfirst($tableName."Service.php"),$this->outputDir.$this->settings['moduleName'].'/services');
        return $file;
    }

    /**
     * @param $primaryKey
     * @param $tableName
     * @param $tableColumns
     * @return bool|mixed|string
     */
    private function makeForm($primaryKey, $tableName, $tableColumns){
        $settings = $this->settings;
        $fileName = $this->filePath."form.php";
        $file = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        $file = str_replace("_PRIMARYKEY_",$primaryKey,$file);
        $file = str_replace("_TABLENAME_",$tableName,$file);
        $file = str_replace("_TABLENAMEUPPER_",ucfirst($tableName),$file);

        $inputs = "\n";
        foreach ($tableColumns as $column){
            if ($column != $primaryKey){
                $inputs .= "\t \$form->addText('$column', '$column')->setAttribute('placeholder','*Zadejte $column'); \n";
            }
        }

        $file = str_replace("//INPUTS",$inputs,$file);

        $this->createFile($file,ucfirst($tableName."FormFactory.php"),$this->outputDir.$this->settings['moduleName'].'/forms');
        return $file;
    }

    /**
     * @param $fileContent
     * @param $fileName
     * @param $filePath
     */
    private function createFile($fileContent, $fileName, $filePath){
        if (!file_exists($filePath)) mkdir($filePath);
        $myfile = fopen($filePath."/".$fileName, "w") or die("Unable to open file!");
        fwrite($myfile, $fileContent);
        fclose($myfile);
    }


}
