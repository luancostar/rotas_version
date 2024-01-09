<?php
require_once('../../database/index.php');

function getRota($db, $id_bairro)
{
        $sql = "SELECT id_regiao
                FROM bairros
                WHERE id = '$id_bairro'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row['id_regiao'];
}


$cpf_cnpj = $_POST['cpf_cnpj'];
$cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
$razao_social = $_POST['razao_social'];
$endereco = $_POST['endereco'];
$endereco_num = $_POST['endereco_num'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$id_regiao = getRota($db, $bairro);
$cidade = $_POST['cidade'];
$contato = $_POST['contato'];
$telefone = $_POST['telefone'];
$hora_limite_coleta = $_POST['hora_limite_coleta'];
$cliente_especial = isset($_POST['cliente_especial']) ? 1 : 0;
$coleta_automatica = isset($_POST['coleta_automatica']) ? 1 : 0;

function clienteExiste($db, $cpf_cnpj)
{
        $sql = "SELECT * 
                FROM clientes
                WHERE cpf_cnpj = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $cpf_cnpj);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
                return false;
        }
        return true;
}

if (!clienteExiste($db, $cpf_cnpj)) {
        $sql = "INSERT INTO clientes(cpf_cnpj, razao_social, endereco, endereco_num, cep, bairro, cidade, contato, telefone, hora_limite_coleta, especial, coleta_automatica)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssssiisssii", $cpf_cnpj, $razao_social, $endereco, $endereco_num, $cep, $bairro, $cidade, $contato, $telefone, $hora_limite_coleta, $cliente_especial, $coleta_automatica);
        $stmt->execute();
        $stmt->close();
        $id_cliente = $db->insert_id;

        $sql = "INSERT INTO enderecos_clientes(id_cliente, endereco, endereco_num, cep, id_bairro, id_cidade, id_regiao, contato, principal)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, 1)";
        $stmt2 = $db->prepare($sql);
        $stmt2->bind_param('isssiiis', $id_cliente, $endereco, $endereco_num, $cep, $bairro, $cidade, $id_regiao, $contato);
        $stmt2->execute();
}

header('Location: ../../pages/cadastros/clientes/listar_clientes.php');
