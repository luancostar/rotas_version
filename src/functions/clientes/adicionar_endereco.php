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

$id_cliente = $_POST['id_cliente'];

$cep = $_POST['cep'];

$id_cidade = $_POST['cidade'];
$id_bairro = $_POST['bairro'];
$id_regiao = getRota($db, $id_bairro);

$endereco = $_POST['endereco'];
$endereco_num = $_POST['endereco_num'];
$contato = $_POST['contato'];

$sql = "INSERT INTO enderecos_clientes(id_cliente, endereco, endereco_num, cep, contato, id_bairro, id_cidade, id_regiao)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("issssiii", $id_cliente, $endereco, $endereco_num, $cep, $contato, $id_bairro, $id_cidade, $id_regiao);
$stmt->execute();
$stmt->close();

header('Location: ../../pages/cadastros/clientes/adicionar_endereco.php');
exit;
