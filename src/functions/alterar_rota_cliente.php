<?php
require_once '../database/index.php';

function getDadosRota($db, $id_rota)
{
        $sql = "SELECT regioes.id_motorista, regioes.id_placa_veiculo
                FROM regioes
                WHERE regioes.id = '$id_rota'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row;
}


$id_endereco_coleta = $_POST['id_endereco_coleta'];
$id_rota = $_POST['id_rota'];
$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];

// Busca dados do cliente
$sql = "UPDATE enderecos_clientes
        SET id_regiao = '$id_rota'
        WHERE id = '$id_endereco_coleta'";
$db->query($sql);

$dados_motorista = getDadosRota($db, $id_rota);
$id_motorista = $dados_motorista['id_motorista'];
$id_placa_veiculo = $dados_motorista['id_placa_veiculo'];

$sql = "UPDATE coletas 
        SET id_motorista = '$id_motorista', id_placa_veiculo = '$id_placa_veiculo'
        WHERE id_endereco_coleta = '$id_endereco_coleta'
        AND data_agendamento BETWEEN '$data_inicial' AND '$data_final'";
$db->query($sql);

header("Location: ../pages/relatorio_bairros.php");
