<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 10:26 AM
 */

namespace config;

class DB
{
    /** @var \PDO */
    public $connection;

    /** @var \mysqli_result */
    public $result;

    private $dns;
    private $username;
    private $password;

    /**
     * Loads DB config file and sets $this->db property
     * Constructor establishes database connection using connectToDb()
     * example usage
     * $db = new MySQLDb;
     */
    public function __construct()
    {
        $this->dns = getenv("DB_DNS");
        $this->username = getenv("DB_USER");
        $this->password = getenv("DB_PASSWORD");

        $this->connectToDb();
    }

    public function __destruct()
    {
        if ($this->connection) {
            $this->connection = null;
        }
    }

    /**
     * @return string
     */
    private function connectToDb()
    {
        try {
            $this->connection = new \PDO($this->dns, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die;
        }
    }

    /**
     * @param $query
     * @return bool|\mysqli_result
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