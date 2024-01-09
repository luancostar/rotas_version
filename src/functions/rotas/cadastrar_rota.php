<?php
require_once '../../database/index.php';
$nome_rota = $_POST['nome_rota'];
$id_motorista = $_POST['id_motorista'];
$id_placa_veiculo = $_POST['id_placa_veiculo'];

$db->real_escape_string($nome_rota);

function regiaoExiste($db, $nome_rota)
{
  $sql = "SELECT * 
          FROM regioes
          WHERE nome = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s", $nome_rota);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (!$row) {
    return false;
  }
  return true;
}

if (!regiaoExiste($db, $nome_rota)) {

  $sql = "INSERT INTO regioes(nome, id_motorista, id_placa_veiculo, status_ativacao)VALUES(?, ?, ?, 1)";

  $stmt = $db->prepare($sql);
  $stmt->bind_param('sii', $nome_rota, $id_motorista, $id_placa_veiculo);
  $stmt->execute();

  $stmt->close();
  $db->close();
}



header('Location: ../../pages/cadastros/rotas/rotas.php');
