<?php
require_once('../../database/index.php');
session_start();

function getDadosColeta($db, $id_cliente)
{
  $sql = "SELECT regioes.id_motorista, regioes.id_placa_veiculo, enderecos_clientes.id AS id_endereco_coleta
          FROM enderecos_clientes
          LEFT JOIN regioes ON regioes.id = enderecos_clientes.id_regiao
          WHERE enderecos_clientes.id_cliente = '$id_cliente'
          AND principal = 1";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  return $row;
}

$id_usuario = $_SESSION['usuario']['id'];
$id_cliente = $_POST['id_cliente'];
$dados_coleta = getDadosColeta($db, $id_cliente);
// dados da coelta automatica
$dias_da_semana = $_POST['dias_semana'];
$data_inicial = new DateTime($_POST['data_inicial']);
$data_final = new DateTime($_POST['data_final']);

$data_atual = $data_inicial;
while ($data_atual <= $data_final) {
  $data_atual_formatada = $data_atual->format('Y-m-d');
  $dia = $data_atual->format('N');

  if (in_array($dia, $dias_da_semana)) {
    $sql = "INSERT INTO coletas (data_agendamento, data_solicitacao, hora_solicitacao, id_cliente, id_endereco_coleta, id_motorista, id_placa_veiculo, criado_por, coleta_automatica) 
            VALUES ('$data_atual_formatada', NOW(), NOW(), ?, ?, ?, ?, ?, '1')";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("iiiii", $id_cliente, $dados_coleta['id_endereco_coleta'], $dados_coleta['id_motorista'], $dados_coleta['id_placa_veiculo'], $id_usuario);
    $stmt->execute();
  }

  $data_atual->modify('+1 day');
}

$sql = "UPDATE clientes 
        SET data_final_coleta_automatica = '{$_POST['data_final']}'
        WHERE id = '$id_cliente'";
$db->query($sql);

header('Location: ../../pages/cadastros/coletas/listar_clientes_coletas_automaticas.php');
