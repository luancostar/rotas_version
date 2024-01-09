<?php
require_once '../../database/index.php';
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome_usuario = $_POST['nome_usuario'];


function usuarioExiste($db, $email) {
  $sql = "SELECT * 
          FROM users
          WHERE email = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if(!$row) {
          return false;
  }
  return true;
}

if(!usuarioExiste($db, $email)) {
  $sql = "INSERT INTO users(name, email, password)VALUES('$nome_usuario', '$email', '$senha')";
  $db->query($sql);
  echo $sql;
  
  $db->close();
}


header('Location: ../../pages/cadastros/usuarios/usuarios.php');
