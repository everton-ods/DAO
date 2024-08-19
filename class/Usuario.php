<?php

class Usuario {

    private $idusuario;
    private $email;
    private $senha;
    

    public function getIdusuario(){

        return $this->idusuario;

    }

    public function setIdusuario($value){

        $this->idusuario = $value;

    }

    public function getEmail(){

        return $this->email;

    }

    public function setEmail($value){

        $this->email = $value;

    }

    public function getSenha(){

        return $this->senha;

    }

    public function setSenha($value){

        $this->senha = $value;

    }


    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

            ":ID"=>$id

        ));

        if (isset($results) && count($results) > 0){

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
      

        }

    }

    public function __toString(){

        return json_encode(array(

            "idusuario"=>$this->getIdusuario(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha(),
           

        ));

    }
    public static function getList(){
        $sql = new Sql() ;
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY email;") ;
    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE email LIKE :SEARCH ORDER BY email",array(
            ":SEARCH" =>"%".$login."%"
        ));
    }
    public function Login($login, $password){
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :LOGIN AND senha = :PASS", array(

            ":LOGIN"=>$login,
            ":PASS"=>$password,

        ));

        if (isset($results) && count($results) > 0){

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
      

        } else{
            throw new Exception('error');
        }
    }

}

