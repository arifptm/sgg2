{{-- Modal chare: Edit Proposal/Edit Product}}
{{----------------------}}
<div class="modal modal-shared-product" tabindex="-1" role="dialog"> 
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-orange">
            <h4 class="no-margin" id="modal_title"></h2>
         </div>
         <div class="modal-body">
            <form id="form-product">
               <input type="hidden" name="product_id" id="product_id">
               <div class="row">
                  <div class="col-md-6">              
                     <div class="form-group">
                        <div class="icheck well well-sm bg-green form-inline">
                           <div class="form-group" style="margin-right: 20px;">
                              <input type="radio" name="product_status" value="pending" id="product_pending">
                              <label for="product_pending" class="no-margin">Pendings</label>
                           </div>
                           <div class="form-group" style="margin-right: 20px;">
                              <input type="radio" name="product_status" value="approved" id="product_approved">
                              <label for="product_approved" class="no-margin">Diterima</label>
                           </div>
                           <div class="form-group">
                              <input type="radio" name="product_status" value="rejected"  id="product_rejected">
                              <label for="product_rejected" class="no-margin">Ditolak</label>
                           </div>         
                        </div>
                     </div>
                      <div class="form-group ">
                        <div class="fileinput" data-provides="fileinput" id="share-fileinput">
                          <div class="row">                                                                
                            <div class="col-md-6"> 
                              <div class="fileinput-new thumbnail" style="width: 140px; height: 100px;">
                                <img class="img-responsive img-current" src="/imagecache/medium/noimage.gif" alt="">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 140px; max-height: 100px;">
                              </div>
                            </div>

                            <div class="col-md-6"> 
                              <span class="btn btn-primary btn-file">
                                <span class="fileinput-new">Pilih gambar</span>
                                <span class="fileinput-exists">Ganti</span>
                                <input type="file" name="image" id="proposal_image">
                              </span>
                              <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
                            </div>
                          </div>
                        </div>
                              
                        <div class="help-block err" id="err-image"></div>
                      </div> 

                     <div class="form-group">
                        <label for='name' class='control-label'>Nama Barang</label>
                        <input name='name' type='text' class='form-control' id='product_name'>                      
                        <div class="label label-danger err" id="err-product-name"></div>
                     </div>     

                     <div class="form-group">
                        <label for='price' class='control-label'>Perkiraan harga</label>
                        <input name='price' type='text' class='form-control' id='product_price'>                      
                        <div class="label label-danger err" id="err-product-price"></div>
                     </div>  

                     <div class="form-group">
                        <label for='url' class='control-label'>Link referensi</label>
                        <input name='url' type='text' class='form-control' id='product_url'>                      
                        <div class="label label-danger err" id="err-product-url"></div>
                     </div>    
                                        
                  </div>
                  <div class="col-md-6">    

                     <div class="icheck well well-sm bg-default form-inline show-if-approved" style="display: none;">
                        <div class="form-group">
                           <input type="checkbox" name="disposable" value="pending" id="disposable">
                           <label for="disposable" class="no-margin">Habis Pakai</label>
                        </div>                     
                     </div>

                     <div class="form-group show-if-approved" style="display: none;">
                        <label for='unit' class='control-label'>Satuan</label>
                        <input name='unit' type='text' class='form-control' id='product_unit'>                      
                        <div class="label label-danger err" id="err-product-unit"></div>
                     </div>   

                     <div class="form-group show-if-approved" style="display: none;">
                        <label for='stock' class='control-label'>Jumlah Stock</label>
                        <input name='stock' type='text' class='form-control' id='product_stock'>                      
                        <div class="label label-danger err" id="err-product-stock"></div>
                     </div>   

                     <div class="form-group show-if-processed" style="display: none;">
                        <label for='body' class='control-label'>Keterangan</label>
                        <textarea name='body' type='text' class='form-control' id='product_body'></textarea>                   
                        <div class="label label-danger err" id="err-product-body"></div>
                     </div>                      

                  </div>
               </div>
               
               <div class="row">
                  <div class="col-md-12">              
                     <div class="form-group">
                        <button class="btn btn-primary btn-share-submit">Simpan</button>
                        <button class="btn btn-default" data-dismiss="modal">Batal</button>
                  </div>                 
               </div>
            </form>
           
         </div>
      </div>
   </div>
</div>