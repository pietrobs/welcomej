<div class="modal fade in" id="congressista_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="title_congressista_modal"></h4>
          </div>
          <div class="modal-body" id="modalInsert">
              <form method="POST" action="<?=base_url("Congressista/setar_pagamento")?>" id="form_congressista" enctype="">

                <input type="hidden" id="id" name="id" readonly="readonly">
                <div class="row">  
                  <div class="form-group col-md-6">
                    <label>Nome completo</label>
                    <input type="text" class="form-control" name="nome" id="nome" readonly="true">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Apelido</label>
                    <input type="text" class="form-control" name="apelido" id="apelido" readonly="true">
                  </div>          
                  <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" id="email" readonly="true">
                  </div>          
                  <div class="form-group col-md-6">
                    <label>Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular" readonly="true">
                  </div>      
                  <div class="form-group col-md-6">
                    <label>CPF</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" readonly="true">
                  </div>              
                  <div class="form-group col-md-6">
                    <label>Empresa Júnior</label>
                    <input type="text" class="form-control" name="empresa_junior" id="empresa_junior" readonly="true">
                  </div>      
                  <div class="form-group col-md-6">
                    <label>EJ é filiada?</label>
                    <select class="form-control" name="filiado_nucleo" id="filiado_nucleo" readonly="true" disabled="">
                      <option value="1">Sim</option>
                      <option value="0">Não</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Possui restrição alimentar?</label>
                    <select class="form-control" name="restricao_alimentar" id="restricao_alimentar" readonly="true">
                      <option value="1">Sim</option>
                      <option value="0">Não</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Quais?</label>
                    <textarea class="form-control" name="descricao_restricao_alimentar" id="descricao_restricao_alimentar" rows="10" readonly="true"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Estado de pagamento</label>
                    <select class="form-control" name="ja_pagou" id="ja_pagou">
                      <option value="2">Isento</option>
                      <option value="1" disabled="true">Pago</option>
                      <option value="0">Não pago</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer row">
                    <button type="submit" class="btn btn-round btn-theme" id="mandabala" value="submit"></button>
                    <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>