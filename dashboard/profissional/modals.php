<!-- Modal Nova Formação-->
<div class="modal fade bd-example-modal-lg" id="md_nova_formacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="novaformacao" method="post" action="../../content/controllers/profissionalController.php?form=novaformacao">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Inserir Nova Formação</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row form-row">

            <div class="col-md-6">
              <div class="form-group">
                <select class="txt_curso" name="txt_curso" id="txt_curso" style='width: 100%;' required></select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class="txt_instituicao" name="txt_instituicao" id="txt_instituicao" style='width: 100%;' required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="txt_situacao" name="txt_situacao" id="txt_situacao" style='width: 100%;' required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="txt_nivel" name="txt_nivel" id="txt_nivel" style='width: 100%;' required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" placeholder="Conclusão" onfocus="(this.type='date')" class="form-control" name="txt_conclusao" id="txt_conclusao">
              </div>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
      </form> 
    </div>
  </div>
</div>



<!-- Modal Nova Experiencia-->
<div class="modal fade bd-example-modal-lg" id="md_nova_experiencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="novaexperiencia" method="post" action="../../content/controllers/profissionalController.php?form=novaexperiencia">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Inserir Nova Experiência</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row form-row">

            <div class="col-md-3">
              <div class="form-group">
                <label>Data de Início</label>
                <select id="mesinicio" name="mesinicio" class="select form-control" >
                  <option value="">Mês</option>
                  <option value="01">Janeiro</option>
                  <option value="02">Fevereiro</option>
                  <option value="03">Março</option>
                  <option value="04">Abril</option>
                  <option value="05">Maio</option>
                  <option value="06">Junho</option>
                  <option value="07">Julho</option>
                  <option value="08">Agosto</option>
                  <option value="09">Setembro</option>
                  <option value="10">Outubro</option>
                  <option value="11">Novembro</option>
                  <option value="12">Dezembro</option>
                </select>

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="visibility: hidden;">-</label>
                <select id="anoinicio" name="anoinicio" class="select form-control" >
                  <option value="">Ano</option>
                  <?php
                  $ano_inicial = date("Y");
                  $qtd = 35;
                  for($i=0; $i <= $qtd; $i++){
                      $ano = $ano_inicial-$i;
                      $ano = sprintf("%02s",$ano);
                      echo "<option value=\"".$ano."\">".$ano."</option>\n";
                  }
                  ?>
                </select>

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Data de Término</label>
                <select id="mestermino" name="mestermino" class="select form-control" >
                  <option value="">Mês</option>
                  <option value="01">Janeiro</option>
                  <option value="02">Fevereiro</option>
                  <option value="03">Março</option>
                  <option value="04">Abril</option>
                  <option value="05">Maio</option>
                  <option value="06">Junho</option>
                  <option value="07">Julho</option>
                  <option value="08">Agosto</option>
                  <option value="09">Setembro</option>
                  <option value="10">Outubro</option>
                  <option value="11">Novembro</option>
                  <option value="12">Dezembro</option>
                </select>

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="visibility: hidden;">-</label>
                <select id="anotermino" name="anotermino" class="select form-control" >
                  <option value="">Ano</option>
                  <?php
                  $ano_inicial = date("Y");
                  $qtd = 35;
                  for($i=0; $i <= $qtd; $i++){
                      $ano = $ano_inicial-$i;
                      $ano = sprintf("%02s",$ano);
                      echo "<option value=\"".$ano."\">".$ano."</option>";
                  }
                  ?>
                </select>
                <div class="form-check" style="margin-top: 5px;">
                  <input type="checkbox" class="form-check-input" id="checkempregoatual" name="checkempregoatual">
                  <label class="form-check-label" for="checkempregoatual">Emprego Atual</label>
                </div>
              </div>


            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="text" placeholder="Cargo" class="form-control" name="txt_cargo" id="txt_cargo">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" placeholder="Empresa" class="form-control" name="txt_empresa" id="txt_empresa">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea placeholder="Atividades" class="form-control" name="txt_atividades" id="txt_atividades"></textarea>
                <small class="text-muted"><span id="txtLengthMaxAtividades">0</span> caracteres restantes</small>
              </div>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
      </form> 
    </div>
  </div>
</div>