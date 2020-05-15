<?php

namespace App\SharedPresenters;

use App\Forms\UploadFileFormFactory;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;
use IPub\VisualPaginator\Components as VisualPaginator;
use Nette\Utils\Validators;

/**
 * Base presenter for all application presenters.
 * 1=root; 2=admin; 3=user; null=public
 */
abstract class BasePresenter extends Presenter {

    /** @persistent */
    public $lock = 0;
    
    /** @persistent */
    public $quickFlash = "";

    /** @var \App\Forms\FilterFormFactory @inject */
    public $filterFormFactory;

    /** @var UploadFileFormFactory @inject */
    public $uploadFileFormFactory;

    public function startup() {
       parent::startup();
        /* Project settings */
        $this->template->devel = false;
        $this->template->rootDir = \DevTools::getRootFolder();
    }


    public function actionDefault(){
        //$this->doLogin();
    }

    protected function createComponentVisualPaginator() {
        // Init visual paginator
        $control = new VisualPaginator\Control;
        return $control;
    }

    public function parseRawBody($body){
        $explodeByAmp = explode('&', $body);
        $finalArray = [];
        foreach ($explodeByAmp as $item){
            $tempArray = explode("=",$item);
            $finalArray[$tempArray[0]] = $tempArray[1];
        }
        return $finalArray;
    }


    protected function createComponentUploadFileForm(){
        return $this->uploadFileFormFactory->create(function () {
        });
    }
    
    protected function createComponentFilterForm(){
        return $this->filterFormFactory->create(function () {
        });
    }
    

    
        protected function beforeRender()
    {
        $this->template->addFilter('testUrl', function ($url) {
            if (Validators::isUrl($url) == true){
                return $url;
            }else{
                return 'http://'.$url;
            }
        });
    }

}
