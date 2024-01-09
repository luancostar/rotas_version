<?php
require_once('../../database/index.php');

$id_pergunta = $_POST['id_pergunta'];
if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM perguntas WHERE id = '$id_pergunta'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE perguntas SET status_ativacao = '$novo_status' WHERE id = '$id_pergunta'";
        $db->query($sql);
        header('Location: ../../pages/cadastros/feedback/listar_perguntas.php');
} 

header('Location: ../../pages/cadastros/feedback/listar_perguntas.php');

