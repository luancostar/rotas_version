<?php
require_once('../../database/index.php');
session_start();

function getDadosRota($db, $id_endereco_coleta)
{
        $sql = "SELECT regioes.id_motorista, regioes.id_placa_veiculo
                FROM enderecos_clientes
                LEFT JOIN regioes ON regioes.id = enderecos_clientes.id_regiao
                WHERE enderecos_clientes.id = '$id_endereco_coleta'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row;
}


$id_usuario = $_SESSION['usuario']['id'];
$id_cliente = $_POST['id_cliente'];

// DADOS DE ENTREGA
$destino_cep = $_POST['cep'];
$destino_numero = $_POST['destino_numero'];
$destino_bairro = $_POST['destino_bairro'];
$destino_cidade = $_POST['destino_cidade'];
$nome_destinatario = $_POST['nome_destinatario'];
$telefone_destinatario = $_POST['telefone_destinatario'];
$local_entrega = $_POST['local_entrega'];

// DADOS DE COLETA
$id_endereco_coleta = $_POST['id_endereco_coleta'];
$dados_motorista = getDadosRota($db, $id_endereco_coleta);
$id_motorista = $dados_motorista['id_motorista'];
$id_placa_veiculo = $dados_motorista['id_placa_veiculo'];

$solicitante_coleta = $_POST['solicitante_coleta'];
$tipo_coleta = $_POST['tipo_coleta'];
$volume_solicitado = $_POST['volume_solicitado'];
$peso_solicitado = $_POST['peso_solicitado'];
$qtd_notas = $_POST['qtd_notas'];
$tipo_embalagem = $_POST['tipo_embalagem'];
$fragil = isset($_POST['fragil']) ? 1 : 0;
$obs = $_POST['obs'];
$data_agendamento = $_POST['data_agendamento'];

$sql = "INSERT INTO coletas (
                        data_solicitacao, 
                        hora_solicitacao, 
                        id_motorista,
                        id_placa_veiculo,
                        id_cliente, 
                        id_endereco_coleta, 
                        destino_bairro, 
                        destino_cep, 
                        destino_numero, 
                        destino_cidade, 
                        nome_destinatario, 
                        telefone_destinatario, 
                        destino_rua, 
                        solicitante_coleta, 
                        tipo_coleta, 
                        volume_solicitado, 
                        peso, 
                        qtd_notas, 
                        tipo_embalagem, 
                        fragil, 
                        obs, 
                        criado_por, 
                        data_agendamento
        ) 
        VALUES (
                NOW(), 
                NOW(),
                '$id_motorista',
                '$id_placa_veiculo',
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->bind_param("iiississsssisisisis", $id_cliente, $id_endereco_coleta, $destino_bairro, $destino_cep, $destino_numero, $destino_cidade, $nome_destinatario, $telefone_destinatario, $local_entrega, $solicitante_coleta, $tipo_coleta, $volume_solicitado, $peso_solicitado, $qtd_notas, $tipo_embalagem, $fragil, $obs, $id_usuario, $data_agendamento);
$stmt->execute();

header('Location: ../../pages/cadastros/coletas/listar_coletas.php');
