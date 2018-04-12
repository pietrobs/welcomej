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
                  <div class="form-group col-md-12">
                    <label>Nome completo</label>
                    <input type="text" class="form-control" name="nome" id="nome" readonly="true">
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
                  <div class="form-group col-md-12">
                    <a href="" name="img_ref" id="img_ref">
                      <img src="" target="_blank" name = "img_comprovante" id="img_comprovante" style="width: 300px; height: 300px;">
                    </a>
                    <a href="" target="_blank" name="pdf_ref" id="pdf_ref" class="btn btn-round btn-theme">Visualizar comprovante</a>
                  </div>
                </div>
                <div class="modal-footer row">
                    <a type="submit" class="btn btn-round btn-theme" id="aprovar" value="submit" href="<?=base_url("Comprovante/aprovar/")?>">Aprovar</a>
                    <a type="submit" class="btn btn-round btn-danger" id="recusar" value="submit" href="<?=base_url("Comprovante/recusar/")?>">Recusar</a>
                    <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>