<?php
/**
 * Created by PhpStorm.
 * User: Tona Nguyen
 * Date: 4/8/2019
 * Time: 10:57 PM
 */
namespace app\models;

class Urls extends \lib\base\Model
{

    /**
     * Urls constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_setTable('urls');
    }

    public function saveData($data)
    {
        return $this->save($data);
    }

    public function getCodeByUrl($url)
    {
        $sql = "SELECT `code` FROM `urls` WHERE original_url = '".$url."'";
        return $this->query($sql)->fetch_assoc();
    }
}