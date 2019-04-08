<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 11:09 AM
 */

namespace app\controllers;


use Symfony\Component\HttpFoundation\Request;

class BaseController
{
    /** @var Request */
    protected $request;

    protected $layout = 'main';

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    /**
     * @return Request
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @param $view
     * @param array $data
     * @throws \Exception
     */
    public function render($view, $data = [])
    {
        $view_file = __DIR__ . '/../views/' . $view .'.php';
        if (is_file($view_file)) {
            extract($data);
            ob_start();
            require_once $view_file;
            $content = ob_get_clean();
            require_once(__DIR__ . '/../layouts/'.$this->layout.'.php');
        } else {
            throw new \Exception("Không tìm thấy tệp " . $view);
        }
    }
}