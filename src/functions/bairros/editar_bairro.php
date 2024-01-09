<?php
require_once '../../database/index.php';
$id_bairro = $_POST['id_bairro'];

if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM bairros WHERE id = '$id_bairro'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE bairros SET status_ativacao = '$novo_status' WHERE id = '$id_bairro'";
        $db->query($sql);
        header('Location: ../../pages/cadastros/bairros/bairros.php');
        exit;
} else {
        $nome_bairro = $_POST['nome_bairro'];
        $id_regiao = $_POST['id_regiao'];
        $nome_cidade = $_POST['nome_cidade'];

        // VERIFICA SE JÁ HÁ BAIRRO COM ESSE NOME
        $sql = "SELECT * 
                FROM bairros 
                WHERE nome = ? 
                AND nome_cidade = ?
                AND id <> '$id_bairro'";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $nome_bairro, $nome_cidade);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
                $sql = "UPDATE bairros 
                        SET nome = ?, id_regiao = ?, nome_cidade = ?
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('sisi', $nome_bairro, $id_regiao, $nome_cidade, $id_bairro);
                $stmt->execute();
                header('Location: ../../pages/cadastros/bairros/bairros.php');
        } else {
                header('Location: ../../pages/cadastros/bairros/bairros.php?erro=duplicata');
        }
}
