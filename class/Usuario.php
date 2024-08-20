<?php

class Usuario
{

    private $idusuario;
    private $email;
    private $senha;


    public function getIdusuario()
    {

        return $this->idusuario;
    }

    public function setIdusuario($value)
    {

        $this->idusuario = $value;
    }

    public function getEmail()
    {

        return $this->email;
    }

    public function setEmail($value)
    {

        $this->email = $value;
    }

    public function getSenha()
    {

        return $this->senha;
    }

    public function setSenha($value)
    {

        $this->senha = $value;
    }


    public function loadById($id)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

            ":ID" => $id

        ));

        if (isset($results) && count($results) > 0) {

            $this->setData($results[0]);
        }
    }

    public function __toString()
    {

        return json_encode(array(

            "idusuario" => $this->getIdusuario(),
            "email" => $this->getEmail(),
            "senha" => $this->getSenha(),


        ));
    }
    public static function getList()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY email;");
    }

    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE email LIKE :SEARCH ORDER BY email", array(
            ":SEARCH" => "%" . $login . "%"
        ));
    }
    public function Login($login, $password)
    {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :LOGIN AND senha = :PASS", array(

            ":LOGIN" => $login,
            ":PASS" => $password,

        ));

        
    }
    public function setData($data)
    {
        $this->setIdusuario($data['idusuario']);
        $this->setEmail($data['email']);
        $this->setSenha($data['senha']);
    }

    public function __construct($login = "", $senha = "")
    {
        $this->setEmail($login);
        $this->setSenha($senha);
    }



    public function insert()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASS)", array(
            ':LOGIN' => $this->getEmail(),
            ':PASS' => $this->getSenha(),
        ));
        if (isset($results) && count($results) > 0) {

            $this->setData($results[0]);
        } else {
            throw new Exception('error');
        }
    }
    public function update($email, $senha)
    {
        $this->setEmail($email);
        $this->setSenha($senha);
        $sql = new Sql();
        $results = $sql->select("UPDATE tb_usuarios SET email = :LOGIN, senha = :PASS WHERE idusuario = :ID", array(
            ':LOGIN' => $this->getEmail(),
            ':PASS' => $this->getSenha(),
            ":ID" => $this->getIdusuario()
        ));

        if (isset($results) && count($results) > 0) {

            $this->setData($results[0]);
        } else {
            throw new Exception('error');
        }
    }
}
