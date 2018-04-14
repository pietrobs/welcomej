<div class="modal fade in" id="recusar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="title_recusar_modal"></h4>
          </div>
          <div class="modal-body" id="modalInsert">
              <form method="POST" action="<?=base_url("Comprovante/recusar")?>" id="form_congressista" enctype="">

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
                    <label>Justificativa</label>
                    <textarea class="form-control" rows="5" name="justificativa"></textarea>
                  </div>
                </div>
                <div class="modal-footer row">
                    <button type="submit" class="btn btn-round btn-theme" id="aprovar" value="submit" href="<?=base_url("Comprovante/aprovar/")?>">Confirmar</button> 
                    <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Cancelar </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>