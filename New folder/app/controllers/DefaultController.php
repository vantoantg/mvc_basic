<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 10:52 AM
 */
namespace app\controllers;

class DefaultController extends BaseController
{
    public function index()
    {
        $this->render('default/index', []);
    }
}