<?php
session_start();

if (!isset($_SESSION['logado_roteirizador'])) {
  header('Location: ../../../index.php');
  exit;
}
require_once('../../../database/index.php');

if (!isset($_POST['id_coleta'])) {
  header('Location: listar_coletas.php');
}

$id_usuario = $_SESSION['usuario']['id'];

$id_coleta = $_POST['id_coleta'];

function getOcorrencias($db)
{
  $ocorrencias = [];
  $sql = "SELECT * FROM ocorrencias";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $ocorrencias[] = $row;
  }

  return $ocorrencias;
}

function getColeta($db, $id_coleta)
{
  $sql = "SELECT status_coleta, data_coleta, hora_coleta, obs_finalizacao_coleta, id_ocorrencia 
          FROM coletas 
          WHERE id = '$id_coleta'";
  $result = $db->query($sql);
  $coleta = $result->fetch_assoc();

  return $coleta;
}

$coleta = getColeta($db, $id_coleta);
?>
