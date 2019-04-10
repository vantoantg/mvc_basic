<?php
namespace app\controllers;

use app\models\Urls;
use lib\base\Helper;

/**
 * Class TestController
 * @package app\controllers
 */
class DefaultController extends ApplicationController
{
	public function indexAction()
	{
        $this->view->settings->url = '';
        if ($this->request->getMethod() == 'POST'){
            $original_url = $this->request->get('original_url');
            if ($original_url && strlen($original_url) <= 500){
                if (filter_var($original_url, FILTER_VALIDATE_URL)) {
                    $code = Helper::getInstance()->generateRandomString(5);
                    $url = new Urls();
                    $check = $url->getCodeByUrl($original_url);
                    if (!$check){
                        $url->saveData($code, $this->request->get('original_url'));
                    }else{
                        $code = $check->code;
                    }

                    $this->view->settings->code = Helper::getInstance()->siteURL().'/'.$code;
                    $this->view->settings->url = $original_url;
                }
            }
        }
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
