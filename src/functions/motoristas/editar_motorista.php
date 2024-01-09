<?php
require_once '../../database/index.php';

$id_motorista = $_POST['id_motorista'];

if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM motoristas WHERE id = '$id_motorista'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE motoristas SET status_ativacao = '$novo_status' WHERE id = '$id_motorista'";
        $db->query($sql);
        $db->close();
        header('Location: ../../pages/cadastros/motoristas/motoristas.php');
} else {
        $nome_motorista = $_POST['nome_motorista'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        // VERIFICA SE JÁ HÁ MOTORISTA COM ESSE CPF
        function motoristaExiste($db, $cpf, $id_motorista)
        {
                $sql = "SELECT * 
                        FROM motoristas
                        WHERE cpf = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $cpf, $id_motorista);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!motoristaExiste($db, $cpf, $id_motorista)) {

                $sql = "UPDATE motoristas 
                SET nome = ?, cpf = ?, senha = ?
                WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('sssi', $nome_motorista, $cpf, $senha, $id_motorista);
                $stmt->execute();
        }
        header('Location: ../../pages/cadastros/motoristas/motoristas.php');
}
