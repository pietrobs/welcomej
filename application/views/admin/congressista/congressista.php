<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Listagem de Congressistas                
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
                          <th><i class="fa fa-font"></i> Nome congressista</th>
                          <th class="hidden-phone"><i class="far fa-user"></i> Data inscrição</th>                                  
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($congressistas as $key => $congressista) :?>
                        <tr>
                          <td><?=$congressista["nome"]?></td>
                          <td><?=$congressista["data_registro"]?></td>
                      
                          <td>
                            <button class = "btn btn-primary btn-xs" 
                                    data-toggle = "modal" 
                                    data-target = "#congressista_modal" 
                                    data-type = "update"
                                    data-id = "<?=$congressista["id"]?>"
                                    data-nome = "<?=$congressista["nome"]?>"
                                    data-email = "<?=$congressista["email"]?>"
                                    data-celular = "<?=$congressista["celular"]?>"
                                    data-data_registro  = "<?=$congressista["data_registro"]?>"
                                    data-apelido = "<?=$congressista["apelido"]?>"
                                    data-rg = "<?=$congressista["rg"]?>"
                                    data-cpf = "<?=$congressista["cpf"]?>"
                                    data-restricao_alimentar = "<?=$congressista["restricao_alimentar"]?>"
                                    data-descricao_restricao_alimentar = "<?=$congressista["descricao_restricao_alimentar"]?>"
                                    data-filiado_nucleo = "<?=$congressista["filiado_nucleo"]?>"
                                    data-empresa_junior = "<?=$congressista["empresa_junior"]?>"
                                    data-ja_pagou = "<?=$congressista["ja_pagou"]?>"
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
      //$(".id_imgsremove").html("")
      //$("#imgview").html("")
      if(action == "update")
      {
        console.log("UPDATE");
        var id = button.data('id') // Extract info from data-* attributes
        modal.find('#title_congressista_modal').text("Visualizar congressista")
        modal.find('#mandabala').text("Salvar")
        modal.find('#id').hide()
        modal.find('#form_eventos').attr("action", "<?=base_url('Congressista/setar_pagamento')?>")
        modal.find('#id').val(button.data("id"))
        modal.find('#nome').val(button.data("nome"))
        modal.find('#apelido').val(button.data("apelido"))
        modal.find('#email').val(button.data("email"))
        modal.find('#celular').val(button.data("celular"))
        modal.find('#cpf').val(button.data("cpf"))
        modal.find('#empresa_junior').val(button.data("empresa_junior"))
        modal.find('#restricao_alimentar').val(button.data("restricao_alimentar"))
        modal.find('#descricao_restricao_alimentar').val(button.data("descricao_restricao_alimentar"))
        ja_pagou = button.data("ja_pagou");
        modal.find('#ja_pagou option').each(function(index){
          if(ja_pagou == 0 && $(this).val() == "1"){
            $(this).attr("disabled", "disabled");
          }else if(ja_pagou == 0){
            $(this).removeAttr("disabled", "");
          }

          if(ja_pagou == 1){
            $(this).attr("disabled", "disabled");
            if(index == 2){
              $(this).removeAttr("disabled");
            }
          }

          if(ja_pagou == 2 && $(this).val() == "1"){
            $(this).attr("disabled", "disabled");
            console.log($(this).val());
          }else if(ja_pagou ==2){
            $(this).removeAttr("disabled");
          }

        });
        modal.find('#ja_pagou').val(button.data("ja_pagou"))
      }
    })
  });
</script>

