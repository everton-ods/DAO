<?php

class Sql extends PDO {
    private $conn;
    public function __construct() {
        parent::__construct("mysql:dbname=projeto;host=localhost", "root", "");
    }
    private function setParametros($statement, $listaParametros = array()) {
        
        foreach($listaParametros as $key => $value) {
            $statement->setParametro($statement, $key, $value);
            $statement->bindParam($key, $value);
        }

    }

    public function execquery($rawQuery, $parametros = array()) {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParametros($stmt, $parametros);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $parametros = array()):array{
        $stmt = $this->query($rawQuery);
        $this->setParametros($stmt, $parametros);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }


}
