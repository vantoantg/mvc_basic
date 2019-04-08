<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 11:06 AM
 */
namespace app;

use app\controllers\DefaultController;

class App
{
    public function run()
    {
        $c = new DefaultController();
        $c->index();
    }
}