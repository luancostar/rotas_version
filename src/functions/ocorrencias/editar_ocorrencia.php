<?php
require_once('../../database/index.php');

$id_ocorrencia = $_POST['id_ocorrencia'];

if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM ocorrencias WHERE id = '$id_ocorrencia'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE ocorrencias SET status_ativacao = '$novo_status' WHERE id = '$id_ocorrencia'";
        $db->query($sql);
        $db->close();
        header('Location: ../../pages/cadastros/ocorrencias/listar_ocorrencias.php');
} else {
        $num_ocorrencia = $_POST['num_ocorrencia'];
        $ocorrencia = $_POST['ocorrencia'];
        $inef_cliente = isset($_POST['inef_cliente']) ? 1 : 0;
        $app_motorista = isset($_POST['app_motorista']) ? 1 : 0;


        function ocorrenciaExiste($db, $num_ocorrencia, $id_ocorrencia)
        {
                $sql = "SELECT * 
                        FROM ocorrencias
                        WHERE num_ocorrencia = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $num_ocorrencia, $id_ocorrencia);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!ocorrenciaExiste($db, $num_ocorrencia, $id_ocorrencia)) {

                $sql = "UPDATE ocorrencias
                SET num_ocorrencia = ?, ocorrencia = ?, inef_cliente = ?, app_motorista = ?
                WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bind_param("isiii", $num_ocorrencia, $ocorrencia, $inef_cliente, $app_motorista, $id_ocorrencia);
                $stmt->execute();
                $stmt->close();
        }

        header('Location: ../../pages/cadastros/ocorrencias/listar_ocorrencias.php');
}
