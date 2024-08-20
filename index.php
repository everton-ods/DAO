<?php

require_once("config.php");

$listUsuarios = Usuario::getList();

echo json_encode($listUsuarios);


echo"\n";


$root = new Usuario();
$root->loadbyId(1);
echo $root;

echo"\n";

$searchUsusario = Usuario::search("ever");
echo json_encode($searchUsusario);

echo "\n";

$loginUser = new Usuario();
$loginUser->Login("everton@gmail.com","123");
echo $loginUser;

echo"";

$aluno = new Usuario("ston@ff.com","123");
$aluno->insert();

echo $aluno;

$usuario = new Usuario();
$usuario->loadbyId(1);
$usuario->update("evert@gmail.com","123");

echo $usuario;







