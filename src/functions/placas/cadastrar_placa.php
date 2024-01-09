<?php
require_once '../../database/index.php';
$placa = $_POST['placa'];

function placaExiste($db, $placa)
{
  $sql = "SELECT * 
          FROM placas
          WHERE placa = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s", $placa);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (!$row) {
    return false;
  }
  return true;
}

if (!placaExiste($db, $placa)) {
  $sql = "INSERT INTO placas(placa)VALUES('$placa')";
  $db->query($sql);

  $db->close();
}

header('Location: ../../pages/cadastros/placas/placas.php');
exit;
