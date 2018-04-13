<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Listagem de Eventos
                <button class       ="btn btn-primary btn-xs" 
                        data-toggle ="modal" 
                        data-target ="#congressista_modal" 
                        data-type   ="new"
                >
                  <i class="fas fa-plus-square"></i> Novo
                </button>
            </h2>
            <div class="row mt">
              <div class="col-md-12">
                <div class="content-panel">
                  <form method="POST" action="" id="pesquisa" name="pesquisa">
                    <div class="form-group">
                      <div class="col-sm-4">
                        <label class="col-sm-12 col-sm-12 control-label">Organizar por</label>
                        <select class="form-control round-form" name="attribute">
                          <option value="nome">Nome congressista</option>
                          <option value="data_registro">Data inscrição</option>
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
                    <div class="col-sm-2">
                      <br/>
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
                          <th><i class="fa fa-font"></i> Nome congressista</th>
                          <th>Status</th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($congressistas as $key => $congressista) : ?>
                        <tr>
                          <td><?=$congressista["nome"]?></td>
                          <td><?=($congressista["status"] == 0) ? "Pendente" : (($congressista["status"] == 1) ? "Recusado" : "Aprovado") ?></td>
                          <td>
                            <button class = "btn btn-primary btn-xs" 
                                    data-toggle = "modal" 
                                    data-target = "#congressista_modal" 
                                    data-type = "update"
                                    data-id = "<?=$congressista["id"]?>"
                                    data-nome = "<?=$congressista["nome"]?>"
                                    data-foto_comprovante = "<?=$congressista["foto_comprovante"]?>"
                                    data-filiado_nucleo = "<?=$congressista["filiado_nucleo"]?>"
                                    data-empresa_junior = "<?=$congressista["empresa_junior"]?>"
                                <i class="fas fa-pencil-alt"></i>
                                Visualizar
                            </button>

                         <!--  <button class="btn btn-danger btn-xs"
                                  data-toggle ="modal"
                                  data-target ="#modalNoticiaExcluir"
                                  data-id     ="<?=$congressista["id"]?>"  >
                              <i class="fas fa-trash-alt"></i>
                          </button> -->

                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div style="margin-left: 2vh;"><?php echo $paginacao; ?></div>
                </div>
              </div>
            </div>

              <div class="modal fade in" id="modalNoticiaExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Deletar Evento</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <p>Tem certeza que deseja excluir o registro?</p>
                          </div>
                        </div>
                        <div class="modal-footer">
                              <a href="" id="linkdelete" class="btn btn-round btn-theme">Excluir </a>
                              <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
                        </div>
                    </div>
                </div>
              </div>
    </section>
  </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#congressista_modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var action = button.data('type')
      var modal = $(this)
      var base_url_aprovar = "<?=base_url("Comprovante/aprovar/")?>"
      var base_url_recusar = "<?=base_url("Comprovante/recusar/")?>"

      if(action == "update")
      {
        console.log("UPDATE");
        var id = button.data('id') // Extract info from data-* attributes
        img = button.data("foto_comprovante");
        modal.find('#title_congressista_modal').text("Visualizar comprovantes")
        modal.find('#id').hide()
        modal.find('#id').val(button.data("id"))
        modal.find('#nome').val(button.data("nome"))
        modal.find('#img_ref').attr("href", button.data("foto_comprovante"))
        modal.find('#img_comprovante').attr("src", button.data("foto_comprovante"))
        if(img.split(".")[1] == "pdf"){
          modal.find('#img_ref').hide();
          modal.find("#pdf_ref").show();
          modal.find('#pdf_ref').attr("href", button.data("foto_comprovante"))
        }else{
          modal.find('#img_ref').show();
          modal.find("#pdf_ref").hide();
        }
        modal.find('#aprovar').attr("href", base_url_aprovar + button.data("id"))
        modal.find('#recusar').attr("href", base_url_recusar + button.data("id"))
        modal.find('#empresa_junior').val(button.data("empresa_junior"))
      }
    })
  });
</script>

