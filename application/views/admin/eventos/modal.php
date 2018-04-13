<div class="modal fade in" id="events_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="title_events_modal"></h4>
          </div>
          <div class="modal-body" id="modalInsert">
              <form method="POST" action="<?=base_url("Minicurso/insere")?>" id="form_eventos" enctype="multipart/form-data">

                <input type="hidden" id="id" name="id" readonly="readonly">
                <div class="form-group">
                  <label>Ministrante:</label>
                  <input type="text" class="form-control round-form" name="ministrante" id="ministrante">
                </div>          
                <div class="form-group">
                  <label>Palestra:</label>
                  <input type="text" class="form-control round-form" name="nome_palestra" id="nome_palestra">
                </div>          
                <div class="form-group">
                  <label>Descrição:</label>
                  <textarea class="form-control" name="descricao_palestra" id="descricao_palestra" style="resize: none" rows="5"></textarea> 
                </div>      
                <div class="form-group">
                  <label>Local:</label>
                  <input type="text" class="form-control round-form" name="local" id="local">
                </div>              
                <div class="form-group">
                  <label>Limite de inscrições:</label>
                  <input type="number" class="form-control round-form" name="limite" id="limite" min="0">
                </div>      
                <div class="form-group">
                  <label>Dia palestra:</label>
                  <select class="form-control round-form" name="dia_palestra" id="dia_palestra">
                    <option value="1">Primeiro dia</option>
                    <option value="1">Segundo dia</option>
                    <option value="1">Terceiro dia</option>
                  </select>
                </div>         
                <div class="form-group">
                  <label>Período da palestra:</label>
                  <select class="form-control round-form" name="periodo_palestra" id="periodo_palestra">
                    <option value="1">Manhã</option>
                    <option value="1">Tarde</option>
                    <option value="1">Noite</option>
                  </select>
                </div>          
                <div class="form-group">
                  <input type="file" name="imagem_palestra" id="imagem_palestra">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-round btn-theme" id="mandabala" value="submit"></button>
                    <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>