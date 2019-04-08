<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/8/2019
 * Time: 10:26 AM
 */
namespace config;

class Database
{
    /**
     * @var \mysqli
     */
    public $connection;

    public $result;

    private $host;
    private $username;
    private $password;
    private $db_name;

    /**
     * Loads DB config file and sets $this->db property
     * Constructor establishes database connection using connectToDb()
     * example usage
     * $db = new MySQLDb;
     */
    public function __construct()
    {
        $this->host = getenv("DB_HOST");
        $this->username = getenv("DB_USER");
        $this->password = getenv("DB_PASSWORD");
        $this->db_name = getenv("DB_NAME");
        $this->connectToDb();
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    /**
     * @return string
     */
    private function connectToDb()
    {
        $this->connection = new \PDO($this->host, $this->username, $this->password, $this->db_name);

        if ($this->connection->connect_error) {
            return "can not connect to database " . $this->connection->connect_error;
        }

        $this->connection->set_charset(getenv("DB_CHARSET"));
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