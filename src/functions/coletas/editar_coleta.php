<?php
require_once('../../database/index.php');
session_start();

function getValoresOriginaisColeta($db, $id_coleta)
{
        $sql = "SELECT * FROM coletas WHERE id = '$id_coleta'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        return $row;
}

function registrarAuditoria($db, $tabela, $id_registro, $coluna, $valor_original, $novo_valor, $id_usuario)
{
        $sql = "INSERT INTO auditorias(tabela, id_registro, coluna, valor_original, novo_valor, id_usuario, data_hora_alteracao)
                VALUES ('$tabela','$id_registro','$coluna','$valor_original','$novo_valor','$id_usuario', NOW())";
        $db->query($sql);
}

$tipo_edicao = $_POST['tipo_edicao'];

switch ($tipo_edicao) {
        case 'editar_coleta':
                $id_coleta = $_POST['id_coleta'];

                $valores_originais = getValoresOriginaisColeta($db, $id_coleta);

                foreach ($valores_originais as $coluna => $valor_original) {
                        if (isset($_POST[$coluna])) {
                                if ($_POST[$coluna] != $valor_original) {
                                        registrarAuditoria($db, 'coletas', $id_coleta, $coluna, $valor_original, $_POST[$coluna], $_SESSION['usuario']['id']);
                                }
                        }
                }

                $id_cliente = $_POST['id_cliente'];

                // DADOS DE ENTREGA
                $destino_cep = $_POST['destino_cep'];
                $destino_numero = $_POST['destino_numero'];
                $destino_bairro = $_POST['destino_bairro'];
                $destino_cidade = $_POST['destino_cidade'];
                $nome_destinatario = $_POST['nome_destinatario'];
                $telefone_destinatario = $_POST['telefone_destinatario'];
                $local_entrega = $_POST['destino_rua'];

                // DADOS DE COLETA
                $id_endereco_coleta = $_POST['id_endereco_coleta'];
                $solicitante_coleta = $_POST['solicitante_coleta'];
                $tipo_coleta = $_POST['tipo_coleta'];
                $volume_solicitado = $_POST['volume_solicitado'];
                $peso_solicitado = $_POST['peso'];
                $qtd_notas = $_POST['qtd_notas'];
                $tipo_embalagem = $_POST['tipo_embalagem'];
                $fragil = isset($_POST['fragil']) ? 1 : 0;
                $obs = $_POST['obs'];
                $data_agendamento = $_POST['data_agendamento'];

                $sql = "UPDATE coletas
                        SET id_cliente = ?,
                        id_endereco_coleta = ?,
                        destino_bairro = ?,
                        destino_cep = ?,
                        destino_numero = ?,
                        destino_cidade = ?,
                        nome_destinatario = ?,
                        telefone_destinatario = ?,
                        destino_rua = ?,
                        solicitante_coleta = ?,
                        tipo_coleta = ?,
                        volume_solicitado = ?,
                        peso = ?,
                        qtd_notas = ?,
                        tipo_embalagem = ?,
                        fragil = ?,
                        obs = ?,
                        data_agendamento = ?
                WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bind_param("iiississsssssiiissi", $id_cliente, $id_endereco_coleta, $destino_bairro, $destino_cep, $destino_numero, $destino_cidade, $nome_destinatario, $telefone_destinatario, $local_entrega, $solicitante_coleta, $tipo_coleta, $volume_solicitado, $peso_solicitado, $qtd_notas, $tipo_embalagem, $fragil, $obs, $data_agendamento, $id_coleta);
                $stmt->execute();
                break;

        case 'cancelar_coleta':
                $id_coleta = $_POST['id_coleta'];

                $sql = "SELECT status_coleta
                        FROM coletas
                        WHERE id = '$id_coleta'";
                $result = $db->query($sql);
                $coleta = $result->fetch_assoc();
                $status_coleta = $coleta['status_coleta'];

                $novo_status = $status_coleta == 1 ? 0 : 1;

                registrarAuditoria($db, 'coletas', $id_coleta, 'status_coleta', $status_coleta, $novo_status, $_SESSION['usuario']['id']);

                $sql = "UPDATE coletas
                SET status_coleta = '$novo_status'
                WHERE id = '$id_coleta'";
                $db->query($sql);
                break;
        case 'editar_motorista_placa':
                $coletas = json_decode($_POST['coletas'], true);
                $ids_coletas = implode("','", $coletas);
                $id_motorista = $_POST['id_motorista'];
                $id_placa_veiculo = $_POST['id_placa_veiculo'];

                foreach ($coletas as $id_coleta) {
                        $valores_originais = getValoresOriginaisColeta($db, $id_coleta);
                        foreach ($valores_originais as $coluna => $valor_original) {
                                if (isset($_POST[$coluna])) {
                                        if ($_POST[$coluna] != $valor_original) {
                                                registrarAuditoria($db, 'coletas', $id_coleta, $coluna, $valor_original, $_POST[$coluna], $_SESSION['usuario']['id']);
                                        }
                                }
                        }
                }

                $sql = "UPDATE coletas 
                        SET id_motorista = '$id_motorista',
                        id_placa_veiculo = '$id_placa_veiculo'
                        WHERE id IN ('$ids_coletas')";

                $result = $db->query($sql);
                header('Location: ../../pages/relatorio_bairros.php');
                exit;
}

header('Location: ../../pages/cadastros/coletas/listar_coletas.php');
