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

    /* @var StockService */
    private $stockService;

    /* @var UserService */
    protected $userService;

    /** @var \App\Forms\FilterFormFactory @inject */
    public $filterFormFactory;

    /** @var UploadFileFormFactory @inject */
    public $uploadFileFormFactory;

    protected $currentOrganisationId = 0;
    protected $organisation;

    protected $root;

    public function getOrganisationId(){
        return $this->currentOrganisationId;
    }

    public function setOrganisationId($id){
        $this->currentOrganisationId = $id;
    }


    public function startup() {
       parent::startup();

        /* Project settings */
        $this->template->devel = false;
    }

    public function actionDefault(){
        //$this->doLogin();
    }

    protected function createComponentVisualPaginator() {
        // Init visual paginator
        $control = new VisualPaginator\Control;
        return $control;
    }

    public function handleProcessAjax(){
        $httpRequest = $this->getHttpRequest();
        if ($httpRequest->isMethod('POST')){
            $body = $this->parseRawBody($httpRequest->getRawBody());
            $formName = $body['formName'];
            $selectName = $body['selectName'];
            $value = $body['value'];

            if ($formName == 'roleOrganisation'){
                if ($value == 1){
                    $data = $this->roleOrganisationService->getUserRoleList();
                }else{
                    $data = $this->roleOrganisationService->getMemberRoleList();
                }
            }elseif($formName == 'editStockItem'){
                $data = $this->stockService->getNewIc(null,$value);
            }


            $this->sendResponse(new JsonResponse(['formName'=>$formName,'selectName'=>$selectName,'data'=>$data]));
        }
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
        $this->template->addFilter('fullname',function ($userId){
            $user = $this->userService->getBy($userId);
            return $user['name']." ".$user['surname'];
        });
        $this->template->addFilter('userFormat',function($dateTime){
           $userFormat = $this->userService->getSettings($this->user->getId());
           return $dateTime->format($userFormat['dateFormat']." ".$userFormat['timeFormat']);
        });
        $this->template->addFilter('userDate',function($dateTime){
            $userFormat = $this->userService->getSettings($this->user->getId());
            return $dateTime->format($userFormat['dateFormat']);
        });
        $this->template->addFilter('userTime',function($dateTime){
            $userFormat = $this->userService->getSettings($this->user->getId());
            return $dateTime->format($userFormat['timeFormat']);
        });

    }

}
