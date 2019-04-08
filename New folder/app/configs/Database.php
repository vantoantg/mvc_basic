<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 10:26 AM
 */
namespace app\configs;

class Database
{
    /**
     * @var \mysqli
     */
    public $connection;

    public $result;

    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $db_name = 'shortlink';

    /**
     * Loads DB config file and sets $this->db property
     * Constructor establishes database connection using connectToDb()
     * example usage
     * $db = new MySQLDb;
     */
    public function __construct()
    {
        $this->connectToDb();
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }

    /**
     * @return string
     */
    private function connectToDb()
    {
        $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->db_name);

        if (mysqli_connect_error()) {
            return "can not connect to database " . mysqli_connect_error();
        }
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function query($query)
    {
        $this->result = $this->connection->query($query);

        return $this->result;
    }

    /**
     * @return array|string
     */
    public function fetch()
    {
        if (!$this->result) {
            return "No results";
        }
        $rows = [];
        while ($row = $this->result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
}