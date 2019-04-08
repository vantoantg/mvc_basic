<?php
namespace app\controllers;

use app\models\Urls;
use config\DB;
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
            if ($original_url){
                if (filter_var($original_url, FILTER_VALIDATE_URL)) {
                    $code = Helper::getInstance()->generateRandomString(5);
                    $url = new Urls();
                    $url->saveData(['code' => $code, 'original_url' => $this->request->get('original_url')]);
                    $check = $url->getCodeByUrl($original_url);
                    echo '<pre>';
                    print_r($check);
                    echo '</pre>';
                    die;

                    $this->view->settings->code = $code;
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
