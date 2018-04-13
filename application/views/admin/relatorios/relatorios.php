<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Gerar relatório
            </h2>
            <div class="row mt">
              <div class="col-md-12">
                <div class="content-panel">  
                  <div class="row" style="padding: 0 10px">
                    <form method="POST" action="<?=base_url("Relatorio/gerar")?>" id="pesquisa" name="pesquisa" style="padding: 0 10px ;" target="_blank">
                      <div class="col-sm-4">
                        <h3><b>Evento:</b></h3>
                        <div class="form-check">
                            <input type="checkbox" name="check_list[]" value="check1"><label>check1</label>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" name="check_list[]" value="check1"><label>check1</label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <h3><b>Palestras/Minicursos:</b></h3>
                        <?php foreach ($palestras as $key => $palestra) : ?>
                        <div class="form-check">
                            <input type="checkbox" name="palestras_list[]" value="<?=$palestra["id_palestra"]?>"><label><?=$palestra["nome_palestra"]?></label>
                        </div>
                        <?php endforeach; ?>
                      </div>                      
                      <div class="col-sm-2">
                        <br/>
                        <button type="submit" class="btn col-sm-12 btn-round btn-theme" value="Gerar">Gerar</button>
                      </div>
                    </form>
                  </div>           

                  <div class="col-sm-12 message">
                    <?php

                    if($this->session->flashdata('sucesso') == TRUE){
                      echo '<br><br><div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Sucesso!</strong> Operação realizada! </div><br>'; 
                    }

                    if($this->session->flashdata('deletado') == TRUE){
                      echo '<br><br><div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Sucesso!</strong> Notícia excluída. </div><br>'; 
                    }
                    if($this->session->flashdata('erro') == TRUE){
                      echo '<br><br><div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Erro!</strong> Não foi possível atualizar a notícia. </div><br>'; 
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
    </section>
  </section>
