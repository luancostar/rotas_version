<?php
require_once '../../database/index.php';
$nome_bairro = $_POST['nome_bairro'];
$id_regiao = $_POST['id_regiao'];
$nome_cidade = $_POST['nome_cidade'];

$db->real_escape_string($nome_bairro);
$db->real_escape_string($nome_cidade);
$db->real_escape_string($id_regiao);

// VERIFICA SE JÁ HÁ BAIRRO COM ESSE NOME
$sql = "SELECT * FROM bairros WHERE nome = ? AND nome_cidade = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('ss', $nome_bairro, $nome_cidade);

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $sql = "INSERT INTO bairros(nome, id_regiao, nome_cidade)VALUES(?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param('sis', $nome_bairro, $id_regiao, $nome_cidade);
    $stmt->execute();

    $stmt->close();
    $db->close();

    header('Location: ../../pages/cadastros/bairros/bairros.php');
    exit;
} else {
    $stmt->close();
    $db->close();

    header('Location: ../../pages/cadastros/bairros/bairros.php?erro=duplicata');
    exit;
}
