<?php

namespace app\controllers;

use app\Application;
use app\models\Urls;
use lib\base\Helper;

/**
 * Class TestController
 * @package app\controllers
 */
class RedirectController extends ApplicationController
{
    public function indexAction()
    {
        $this->view->disableView();

        $app = new Application();
        $code = str_replace('/', '', $app->getUri());

        if ($this->request->getMethod() == 'GET' && $code) {
            $url = new Urls();
            $check = $url->getUrlByCode($code);
            if ($check) {
                header('Location: ' . $check->original_url);
            } else {
                header('Location: ' . Helper::getInstance()->siteURL());
            }
        }
    }

    public function checkAction()
    {
        echo "hello from test::check";
    }
}
