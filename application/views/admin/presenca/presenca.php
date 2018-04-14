<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Listagem de Eventos
            </h2>
            <div class="row mt">
              <div class="col-md-12">
                <div class="content-panel">
                  <form method="POST" action="" id="pesquisa" name="pesquisa">
                    <div class="form-group">
                      <div class="col-sm-4">
                        <label class="col-sm-12 col-sm-12 control-label">Organizar por</label>
                        <select class="form-control round-form" name="attribute">
                          <option value="nome_palestra">Nome palestra</option>
                          <option value="ministrante">Ministrante</option>
                          <option value="limite">Limite inscrições</option>
                          <option value="dia_palestra">Dia da palestra</option>
                        </select>
                      </div>

                      <div class="col-sm-4">
                        <label class="col-sm-12 col-sm-12 control-label">Tipo de ordenação</label>
                        <select class="form-control round-form" name="order_by">
                          <option value="ASC">Alfabética/Crescente</option>
                          <option value="DESC">Decrescente</option>
                        </select>
                      </div>

                      <div class="col-sm-4">
                        <label class="col-sm-12 col-sm-12 control-label">Quantidade</label>
                        <select class="form-control round-form" name="quantidade">
                          <option>10</option>
                          <option>20</option>
                          <option>50</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-10">
                        <label class="col-sm-12 col-sm-12 control-label"  style="margin-top: 10px">Procurar por:</label>
                        <input type="text" name="search_by" class="form-control round-form">
                      </div>
                      <div class="col-sm-2" style="padding-top: 32px;">
                        <button type="submit" class="btn col-sm-12 btn-round btn-theme" value="Pesquisar">Pesquisar </button>
                      </div>
                    </div>
                  </form>

                  <br><br><br><br><br>

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
                  <table class="table table-striped table-advance table-hover">
                    <thead>
                      <tr>
                          <th><i class="fa fa-font"></i> Nome Palestra</th>
                          <th class="hidden-phone"><i class="far fa-user"></i> Ministrante</th>                                  
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($eventos as $key => $evento) :?>
                        <tr>
                          <td><?=$evento["nome_palestra"]?></td>
                          <td><?=$evento["ministrante"]?></td>
                      
                          <td>
                            <a class = "btn btn-primary btn-xs" 
                               href = "<?=base_url("Admin/presencaEvento/".$evento["id_palestra"])?>">
                                Selecionar
                            </a>                        
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div style="margin-left: 2vh;"><?php echo $paginacao; ?></div>
                </div>
              </div>
            </div>
    </section>
  </section>

