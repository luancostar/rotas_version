<?php
require_once('../../database/index.php');

$nome_embalagem = $_POST['nome_embalagem'];

function embalagemExiste($db, $nome_embalagem)
{
        $sql = "SELECT * 
                FROM embalagens
                WHERE nome = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $nome_embalagem);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
                return false;
        }
        return true;
}

if (!embalagemExiste($db, $nome_embalagem)) {

        $sql = "INSERT INTO embalagens(nome)
        VALUES(?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $nome_embalagem);
        $stmt->execute();
        $stmt->close();
}

header('Location: ../../pages/cadastros/embalagens/listar_embalagens.php');
