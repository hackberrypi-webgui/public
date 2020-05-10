<?php
/**
 * Created by PhpStorm.
 * User: witas
 * Date: 16.12.17
 * Time: 12:31
 */

class ProjectFile
{

    private $organisationId;

    public function __construct($organisationId = 0){
        $this->organisationId = $organisationId;

    }

    public function getFiles($path,$folder){
        $files = (scandir($path.$folder));
        $onlyFiles = [];
        foreach ($files as $file){
            if (strlen($file)>3){
                $onlyFiles[] = [
                    'name'=>$file,
                    'fullpath'=>$path."/".$file,
                    'htmlpath'=>$folder.$file,
                    'htmlthumbnailpath'=>$folder.'thumbnails/'.$file];
            }
        }
        return $onlyFiles;
    }

    public function getAllImages(){
        return $this->getFiles(__WWWDIR__,"/images/s");
    }

    public function getAllStockImages(){
        return $this->getFiles(__WWWDIR__,"/organisation/".$this->organisationId."/stockImages/");
    }

    public function formatFileListAsHtmlImages($files){
        $returnString = "";
        foreach ($files as $file){
            if (is_file('"../..'.$file['htmlpath'].'"')){
                $returnString .= '<img src="../..'.$file['htmlpath'].'" data-name="'.substr($file['name'],0,-4).'" />';
            }
        }
        return $returnString;
    }

}