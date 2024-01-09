<?php
require_once('../../database/index.php');

$nome_cidade = $_POST['nome_cidade'];
$uf = $_POST['uf'];

function cidadeExiste($db, $nome_cidade, $uf)
{
        $nome_cidade = strtoupper($nome_cidade);
        $sql = "SELECT * 
                FROM cidades
                WHERE nome = ? AND uf = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $nome_cidade, $uf);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
                return false;
        }
        return true;
}

if (!cidadeExiste($db, $nome_cidade, $uf)) {
        $nome_cidade = strtoupper($nome_cidade);

        $sql = "INSERT INTO cidades(nome, uf)
                VALUES(?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $nome_cidade, $uf);
        $stmt->execute();
        $stmt->close();
}

header('Location: ../../pages/cadastros/cidades/listar_cidades.php');
