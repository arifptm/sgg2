   <div class="modal modal-lineitem fade" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="form-lineitem">
               {{ csrf_field() }}
               <div class="modal-header bg-purple">
                  <button type="button" class="close text-gray" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <h3 id="datatitle"></h3>  
                  </div>
                  <hr>    
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group" >
                           <div class="form-group">
                              <label for='quantity' class='control-label'>Jumlah permintaan</label>
                              <input name='quantity' type='text' class='form-control' id='quantity'> 
                              <div class="" id="dataunit"></div>
                              <div class="help-block err" id="err-quantity"></div>
                           </div>
                        </div>
                        <div class="form-group" >
                           <div class="form-group">
                              <label for='notes' class='control-label'>Catatan</label>
                              <textarea name='notes' type='text' class='form-control' id='notes' rows="3"> </textarea>
                              <div class="help-block err" id="err-notes"></div>
                           </div>
                        </div>                        
                     </div>
                                             
                     <div class="form-group col-sm-6">
                        <span id="dataimage"></span>
                     </div>                
                  </div>
               </div>
               <input name="product_id" type="hidden" id="product_id">               
               <input name="lineitem_id" type="hidden" id="lineitem_id">               
            </form>
            <div class="modal-footer"></div>
            
         </div>
      </div>
   </div>