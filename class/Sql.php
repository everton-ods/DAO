<?php
class Sql extends PDO {
    private $conn;
    private $dbname = "projeto";
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    public function __construct(){
        $str = sprintf("mysql:dbname=%s;host=%s", $this->dbname, $this->host);
        parent::__construct($str, $this->username, $this->password);
    }
    private function setParametros($statement, $listaParametros = array()){
        foreach($listaParametros as $key => $value) {
            $statement->setParametro($statement, $key, $value);
            $statement->bindParam($key, $value);
        }

    }
    public function execquery($rawQuery, $parametros = array()){
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


}
