<?php
require_once('../../database/index.php');
$id_cliente = $_POST['id_cliente'];

if (isset($_POST['status_ativacao'])) {
        $sql = "SELECT status_ativacao FROM clientes WHERE id = '$id_cliente'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE clientes 
                SET status_ativacao = '$novo_status', data_final_coleta_automatica = '0000-00-00'
                WHERE id = '$id_cliente'";
        $db->query($sql);

        if ($novo_status == 0) {
                $hoje = date("Y-m-d");
                // excluir coletas automaticas
                $sql = "DELETE FROM coletas
                        WHERE id_cliente = '$id_cliente'
                        AND data_agendamento > '$hoje'";
                $db->query($sql);
        }

        header('Location: ../../pages/cadastros/clientes/listar_clientes.php');
} else {

        $cpf_cnpj = $_POST['cpf_cnpj'];
        $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
        $razao_social = $_POST['razao_social'];
        $endereco = $_POST['endereco'];
        $endereco_num = $_POST['endereco_num'];
        $cep = $_POST['cep'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $contato = $_POST['contato'];
        $telefone = $_POST['telefone'];
        $hora_limite_coleta = $_POST['hora_limite_coleta'];
        $cliente_especial = isset($_POST['cliente_especial']) ? 1 : 0;
        $coleta_automatica = isset($_POST['coleta_automatica']) ? 1 : 0;


        function clienteExiste($db, $cpf_cnpj, $id_cliente)
        {
                $sql = "SELECT * 
                        FROM clientes
                        WHERE cpf_cnpj = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ss", $cpf_cnpj, $id_cliente);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!clienteExiste($db, $cpf_cnpj, $id_cliente)) {

                $sql = "UPDATE clientes 
                SET cpf_cnpj = ?, razao_social = ?, endereco = ?, endereco_num = ?, cep = ?, cidade = ?, bairro = ?, contato = ?, telefone = ?, hora_limite_coleta = ?, especial = ?, coleta_automatica = ?
                WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bind_param("sssssiisssiii", $cpf_cnpj, $razao_social, $endereco, $endereco_num, $cep, $cidade, $bairro, $contato, $telefone, $hora_limite_coleta, $cliente_especial, $coleta_automatica, $id_cliente);
                $stmt->execute();
                $stmt->close();
        }
        header('Location: ../../pages/cadastros/clientes/listar_clientes.php');
}
