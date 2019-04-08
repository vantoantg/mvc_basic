<?php
namespace app\controllers;

use config\Database;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends ApplicationController
{
	public function indexAction()
	{
	    $db = new Database();
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
