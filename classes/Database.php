<?php

include_once "config.php";

class Database {

    private $host = "DM_NAME"; 
    private $username = 'DM_USER'; 
    private $password = 'DM_PASSWORD'; 
    private $dbname = 'DM_HOST';
    private $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die('Erreur de connexion : ' . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        $this->connection->close();
    }
}

?>
