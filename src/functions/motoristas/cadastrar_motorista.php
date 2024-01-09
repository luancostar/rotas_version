<?php
require_once '../../database/index.php';
$cpf = $_POST['cpf'];
$cpf = str_replace(array(".", "-"), "", $cpf);
$senha = $_POST['senha'];
$nome_motorista = $_POST['nome_motorista'];

function motoristaExiste($db, $cpf)
{
  $sql = "SELECT * 
          FROM motoristas
          WHERE cpf = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s", $cpf);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (!$row) {
    return false;
  }
  return true;
}

if (!motoristaExiste($db, $cpf)) {
  $sql = "INSERT INTO motoristas(nome, cpf, senha)VALUES('$nome_motorista', '$cpf', '$senha')";
  $db->query($sql);

  $db->close();
}


header('Location: ../../pages/cadastros/motoristas/motoristas.php');
