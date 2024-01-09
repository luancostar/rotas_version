
 
          
  <form action="functions/relatorios_excel/coletas.php" method="post">
    <input type="hidden" name="data_inicial" value="<?= $data_inicial ?>">
    <input type="hidden" name="data_final" value="<?= $data_final ?>">
    <button style=" display: flex;align-items: center;width: fit-content;justify-content: center;" type="submit" class="btn btn-success"><i class="bx bx-file icon"></i> Exportar Relatório</button>
  </form>
 
  <br>
  <div class="d-flex md-12">
  <form class="d-flex align-items-baseline"  action="" method="post">
   <p >DE:</p> <input class="form-control" style="margin-left: 10px;" type="date" name="data_inicial" value="<?= $data_inicial ?>">
    <p >ATÉ:</p> <input class="form-control" style="margin-left: 10px;"s type="date" name="data_final" value="<?= $data_final ?>">

    <button style="margin-left: 10px;" class="btn btn-primary" type="submit">Buscar</button>
  </form>
  </div>
        <div class="tb_search">
        <input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
      </div>
      </div>
      <table class="table table-striped table-class" id= "table-id">
  
	
      <script>
    window.onload = function() {
      // Obtém a referência para a tabela
      var tabela = document.getElementById("minhaTabela");

      // Obtém todas as células da tabela
      var celulas = tabela.getElementsByTagName("td");

      // Loop pelas células
      for (var i = 0; i < celulas.length; i++) {
        // Verifica se o texto da célula contém a palavra "Coletado"
        if (celulas[i].innerText.indexOf("Coletado") !== -1) {
          // Adiciona a classe "destacado" à célula
          celulas[i].classList.add("destacado");
        } else if (celulas[i].innerText.indexOf("Cancelado") !== -1) {
          // Adiciona a classe "destacado" à célula
          celulas[i].classList.add("destacado1");
        } else if (celulas[i].innerText.indexOf("Não coletado (cliente)") !== -1) {
          // Adiciona a classe "destacado" à célula
          celulas[i].classList.add("destacado2");
        } else if (celulas[i].innerText.indexOf("Não coletado (VB)") !== -1) {
          // Adiciona a classe "destacado" à célula
          celulas[i].classList.add("destacado3");
        }
      }
    };
  </script>


  <thead>
  <tr>
  <th>Coleta</th>
        <th>CPF/CNPJ Cliente</th>
        <th>Razão social</th>
        <th>Data de solicitação</th>
        <th>Hora de solicitacao</th>
        <th>Data do Agendamento</th>
        <th>Motorista</th>
        <th>Placa do veículo</th>
        <th>Tipo Coleta</th>
        <th>Volume Solicitado</th>
        <th>Peso Solicitado</th>
        <th>Observações</th>
        <th>Info. da Coleta</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
  <tbody>
 
  <?php
      $totalRespostas = 0;

      foreach (getColetas($db, $data_inicial, $data_final) as $coleta) : $totalRespostas++; ?>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop<?= $coleta['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Preenchimento de Feedback</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="contents">
                <p> Coleta de Nº: <?= $coleta['id'] ?><br><?= $coleta['razao_social'] ?></p>
              </div>
              <div class="modal-body">

                <form method="post" action="functions/feedback/criar_feedback.php" class="row g-12">
                  <?php foreach (getPerguntas($db) as $pergunta) { ?>
                    <div class="col-12">
                      <label for="inputAddress" class="form-label"><?= $pergunta['pergunta'] ?></label>
                      <textarea col="5" row="5" name="resposta<?= $pergunta['id'] ?>" maxlength="255" class="form-control" id="inputAddress"></textarea>
                      <input type="hidden" name="id_pergunta" value="<?= $pergunta['id'] ?>">
                    </div>
                  <?php } ?>
                  <div class="modal-footer">
                    <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                    <input type="hidden" name="usuario_inclusao" value="<?= $id_usuario ?>">
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

          <?php
          if ($coleta['coleta_automatica'] == 0) {
            $coleta_automatica = '';
          } elseif ($coleta['coleta_automatica'] == 1) {
            $coleta_automatica = '<img title="Esta é uma Coleta Automática" style="cursor: pointer;width: 15px; border-radius: 100%;" src=" images/automatic.png">';
          } ?>
          <tr>
            <td style="text-align: center;background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['id'] ?> </td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['cpf_cnpj_cliente'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174);background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['razao_social'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= date('d/m/Y', strtotime($coleta['data_solicitacao'])) ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['hora_solicitacao'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= date('d/m/Y', strtotime($coleta['data_agendamento'])) ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174);background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['nome_motorista'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['placa_veiculo'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['tipo_coleta'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['volume_solicitado'] ?></td>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['peso'] ?></td>
            <td data-toggle="tooltip" data-placement="top" title="<?= $coleta['obs'] ?>" class="obsTd" style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;"><?= $coleta['obs'] ?> </td>
            <td style="text-align: center;background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174); background: #00ab36e0; color: #fff;" : "" ?>;">
              <p class="d-flex justify-content-evenly td--icons"><?= $coleta_automatica ?><small style="cursor: pointer;" title="Existem <?= $coleta['qtd_notas'] ?> Notas para esta coleta" id="td--small"><?= $coleta['qtd_notas'] ?></small> </p>
            </td>
            <td data-toggle="tooltip" data-placement="top" title=" <?= $coleta['id_ocorrencia'] == 0 ? "-" : getOcorrenciaById($db, $coleta['id_ocorrencia']) ?>" style="cursor: help;background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174);  background: #00ab36e0; color: #fff;" : "" ?>;">
              <?php
              $status_coleta = $coleta['status_coleta'];
              if ($status_coleta == 3) {
                if (ineficienciaCliente($db, $coleta['id_ocorrencia'])) {
                  echo getStatuscoleta(4);
                } else {
                  echo getStatuscoleta(3);
                }
              } else {
                echo getStatuscoleta($status_coleta);
              }
              ?>
            </td>
            <style>
              small {
                background-image: url(images/note.png);
                padding-left: 5px;
                padding-right: 5px;
                padding-bottom: 2px;
                border-radius: 100%;
                font-size: 9px;
                color: #000;
                background-position: center;
                background-size: 25px;
              }
            </style>
            <td style="background-color: <?= $coleta['cliente_especial'] == 1 ? " background: rgb(179,238,174);background: #00ab36e0; color: #fff;" : "" ?>;">
              <div class="btn-group">
                <button class="btn btn-warning emphasis btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Ações
                </button>
                <ul id="action-ul" class="dropdown-menu">
                  <li class="d-grid justify-content-center">
                    <button id="btn-icons" style="border: none;align-items: center;" class=" mb-1 w-100 btn btn-primary border-none" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $coleta['id'] ?>">
                     Feedback
                    </button>
                    <form class="edit-form" target="_blank" action="ordem_coleta.php" method="post">
                      <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                      <button class="w-100 btn btn-primary mb-1 border-none" id="btn-icons" type="submit"> Imprimir</button>
                    </form>
                    <form target="_blank" class="edit-form" action="consultar_coleta.php" method="post">
                      <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                      <button class="w-100 btn btn-primary mb-1  border-none" onclick="abrirLink()" id="btn-icons" type="submit"> Consultar</button>
                    </form>
                    <form class="edit-form" action="editar_coleta.php" method="post">
                      <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                      <button class="w-100 btn btn-primary mb-1  border-none" id="btn-icons" type="submit"> Editar</button>
                    </form>
                    <form class="edit-form" action="finalizar_coleta.php" method="post">
                      <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                      <button class="w-100 btn btn-success mb-1  border-none" id="btn-icons" type="submit"> Finalizar</button>
                    </form>
                    <form class="edit-form" action="functions/coletas/editar_coleta.php" method="post">
                      <input type="hidden" name="id_coleta" value="<?= $coleta['id'] ?>">
                      <input type="hidden" name="tipo_edicao" value="cancelar_coleta">
                      <button class="w-100 btn btn-danger mb-1  border-none" id="btn-icons" type="submit"> Cancelar</button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        <!-- Adicione mais linhas conforme necessário -->
      <tbody>
  </table>
 



<!--  Developed By Yasser Mas -->


