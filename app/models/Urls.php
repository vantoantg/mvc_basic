<?php
/**
 * Created by PhpStorm.
 * User: Tona Nguyen
 * Date: 4/8/2019
 * Time: 10:57 PM
 */
namespace app\models;

use Carbon\Carbon;

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

    public function saveData($code, $original_url)
    {
        $created_at = Carbon::now()->format('Y-m-d H:i:s');
        $stmt = $this->connection->prepare("INSERT INTO urls (code, original_url, created_at) VALUES(:code, :original_url, :created_at)");
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':original_url', $original_url);
        $stmt->bindValue(':created_at', $created_at);
        return $stmt->execute();
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getCodeByUrl($url)
    {
        $original_url = addslashes($url);
        $sql = "SELECT `code` FROM `urls` WHERE original_url = '$original_url'";
        $query = $this->connection->query($sql);

        return $query->fetchObject();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getUrlByCode($code)
    {
        $code = addslashes($code);
        $sql = "SELECT `original_url` FROM `urls` WHERE code = '$code'";
        $query = $this->connection->query($sql);
        return $query->fetchObject();
    }
}