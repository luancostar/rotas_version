<?php
require_once '../../database/index.php';

$id_rota = $_POST['id_rota'];
if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM regioes WHERE id = '$id_rota'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE regioes SET status_ativacao = '$novo_status' WHERE id = '$id_rota'";
        $db->query($sql);
        $db->close();
        header('Location: ../../pages/cadastros/rotas/rotas.php');
} else {
        $nome_rota = $_POST['nome_rota'];
        $id_motorista = $_POST['id_motorista'];
        $id_placa_veiculo = $_POST['id_placa_veiculo'];


        function regiaoExiste($db, $nome_rota, $id_rota)
        {
                $sql = "SELECT * 
                        FROM regioes
                        WHERE nome = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $nome_rota, $id_rota);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }


        if (!regiaoExiste($db, $nome_rota, $id_rota)) {
                $sql = "UPDATE regioes 
                        SET nome = ?, id_motorista = ?, id_placa_veiculo = ?
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('siii', $nome_rota, $id_motorista, $id_placa_veiculo, $id_rota);
                $stmt->execute();
        }


        if (isset($_POST['romaneio'])) {
                header('Location: ../../pages/relatorio_bairros.php');
                exit;
        } else {
                header('Location: ../../pages/cadastros/rotas/rotas.php');
                exit;
        }
}
