<?php
require_once('../../database/index.php');

$id_pergunta = $_POST['id_pergunta'];
$usuario_inclusao = $_POST['usuario_inclusao'];
$id_coleta = $_POST['id_coleta'];

function getPerguntas($db)
{
  $perguntas = [];
  $sql = "SELECT * FROM perguntas";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $perguntas[] = $row;
  }

  return $perguntas;
}

foreach (getPerguntas($db) as $pergunta) {    
        $nome_resposta = "resposta".$pergunta['id'];
       
        $sql = "INSERT INTO respostas_feedback(id_coleta, id_pergunta, resposta, usuario_inclusao)
        VALUES(?, ?, ?, ?)";
                
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iisi", $id_coleta, $pergunta['id'], $_POST[$nome_resposta], $usuario_inclusao);
        $stmt->execute();
        $stmt->close();
}

header('Location: ../../pages/cadastros/coletas/listar_coletas.php');
