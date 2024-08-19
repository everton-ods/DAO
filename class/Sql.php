<?php

class Sql extends PDO {

    private $conn;
    private $dbname = "projeto";
    private $host = "localhost";
    private $username = "root";
    private $password = "";

    public function __construct() {

        $str = sprintf("mysql:dbname=%s;host=%s", $this->dbname, $this->host);

        $this->conn = new PDO($str, $this->username, $this->password);

    }

    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->setParam($statement, $key, $value);

        }

    }

    private function setParam($statement, $key, $value){

        $statement->bindParam($key, $value);

    }

    public function execquery($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }


    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->execquery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



}

?>