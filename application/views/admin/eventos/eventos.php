<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Listagem de Eventos
                <button class       ="btn btn-primary btn-xs" 
                        data-toggle ="modal" 
                        data-target ="#events_modal" 
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
                            <button class = "btn btn-primary btn-xs" 
                                    data-toggle = "modal" 
                                    data-target = "#events_modal" 
                                    data-type = "update"
                                    data-id = "<?=$evento["id_palestra"]?>"
                                    data-nome_palestra = "<?=$evento["nome_palestra"]?>"
                                    data-ministrante = "<?=$evento["ministrante"]?>"
                                    data-descricao_palestra = "<?=$evento["descricao_palestra"]?>"
                                    data-local  = "<?=$evento["local"]?>"
                                    data-limite = "<?=$evento["limite"]?>"
                                    data-dia_palestra = "<?=$evento["dia_palestra"]?>"
                                    data-periodo_palestra = "<?=$evento["periodo_palestra"]?>"
                                <i class="fas fa-pencil-alt"></i>
                                Atualizar
                            </button>

                          <button class="btn btn-danger btn-xs"
                                  data-toggle ="modal"
                                  data-target ="#modalNoticiaExcluir"
                                  data-id     ="<?=$evento["id_palestra"]?>"  >
                              <i class="fas fa-trash-alt"></i>
                          </button>

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
    $('#events_modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var action = button.data('type')
      var modal = $(this)
      //$(".id_imgsremove").html("")
      //$("#imgview").html("")

      if(action == "new")
      {
        modal.find('#title_events_modal').text("Novo Evento")
        modal.find('#mandabala').text("Salvar")
        modal.find('#id').hide()
        modal.find('#form_eventos').attr("action", "<?=base_url('Minicurso/insere')?>")
        modal.find('#id').val("")
        modal.find('#nome_palestra').val("")
        modal.find('#ministrante').val("")
        modal.find('#descricao_palestra').val("")
        modal.find('#local').val("")
        modal.find('#limite').val("")
        modal.find('#dia_palestra').val("")
        modal.find('#periodo_palestra').val("")
      }
      else if(action == "update")
      {
        console.log("UPDATE");
        var id = button.data('id') // Extract info from data-* attributes
        modal.find('#title_events_modal').text("Atualizar Evento")
        modal.find('#mandabala').text("Salvar")
        modal.find('#id').hide()
        modal.find('#form_eventos').attr("action", "<?=base_url('Minicurso/atualiza')?>")
        modal.find('#id').val(button.data("id"))
        modal.find('#nome_palestra').val(button.data("nome_palestra"))
        modal.find('#ministrante').val(button.data("ministrante"))
        modal.find('#descricao_palestra').val(button.data("descricao_palestra"))
        modal.find('#local').val(button.data("local"))
        modal.find('#limite').val(button.data("limite"))
        modal.find('#dia_palestra').val(button.data("dia_palestra"))
        modal.find('#periodo_palestra').val(button.data("periodo_palestra"))
      }
    })

    $('#modalNoticiaExcluir').on('show.bs.modal', function (event) {
      var button  = $(event.relatedTarget) // Button that triggered the modal
      var id      = button.data('id') // Extract info from data-* attributes
      var link    = "<?=base_url('Minicurso/deletar/')?>" + id
      var modal = $(this)
      modal.find('#linkdelete').attr("href", link);
      //modal.find('#titulo').val(titulo)
      //modal.find('#descricao').val(descricao)
    })
  });
</script>

