<?php
namespace app\controllers;

use config\DB;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends ApplicationController
{
	public function indexAction()
	{
	    $db = new DB();
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
