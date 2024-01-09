<?php
require_once('../../database/index.php');

$id_embalagem = $_POST['id_embalagem'];
if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM embalagens WHERE id = '$id_embalagem'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE embalagens SET status_ativacao = '$novo_status' WHERE id = '$id_embalagem'";
        $db->query($sql);
        header('Location: ../../pages/cadastros/embalagens/listar_embalagens.php');
} else {
        $nome_embalagem = $_POST['nome_embalagem'];
        function embalagemExiste($db, $nome_embalagem, $id_embalagem)
        {
                $sql = "SELECT * 
                        FROM embalagens
                        WHERE nome = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $nome_embalagem, $id_embalagem);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!embalagemExiste($db, $nome_embalagem, $id_embalagem)) {

                $sql = "UPDATE embalagens
                        SET nome = ?
                        WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $nome_embalagem, $id_embalagem);
                $stmt->execute();
                $stmt->close();
        }


        header('Location: ../../pages/cadastros/embalagens/listar_embalagens.php');
}
