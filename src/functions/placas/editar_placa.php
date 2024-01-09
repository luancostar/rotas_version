<?php
require_once '../../database/index.php';
$id_placa = $_POST['id_placa'];

if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM placas WHERE id = '$id_placa'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE placas SET status_ativacao = '$novo_status' WHERE id = '$id_placa'";
        $db->query($sql);
        $db->close();
        header('Location: ../../pages/cadastros/placas/placas.php');
} else {

        $placa = $_POST['placa'];

        // VERIFICA SE JÁ HÁ MOTORISTA COM ESSE CPF
        function placaExiste($db, $placa, $id_placa)
        {
                $sql = "SELECT * 
                        FROM placas
                        WHERE placa = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $placa, $id_placa);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!placaExiste($db, $placa, $id_placa)) {

                $sql = "UPDATE placas 
                        SET placa = ?
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('si', $placa, $id_placa);
                $stmt->execute();
        }
        header('Location: ../../pages/cadastros/placas/placas.php');
}
