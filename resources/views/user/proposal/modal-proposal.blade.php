   <div class="modal fade modal-proposal" role="dialog">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            
               <div class="modal-header bg-purple">
                  <button type="button" class="close text-gray" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
               </div>
               
               <form id="form-proposal">
                  <div class="modal-body">                  
                     <div class="row">
                          <div class="col-sm-6">                        
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
                              <input name='name' type='text' class='form-control' id='name'>
                              <div class="help-block err" id="err-name"></div>
                           </div>

                           <div class="form-group">
                              <label for='unit' class='control-label'>Satuan</label>
                              <input name='unit' type='text' class='form-control' id='unit'> 
                              <div class="help-block err" id="err-unit"></div>
                           </div>

                        </div>   

                        <div class="form-group col-sm-6">
                           <div class="form-group">

                              <div class="form-group">
                                 <label for='price' class='control-label'>Perkiraan harga</label>
                                 <input name='price' type='text' class='form-control' id='price'> 
                                 <div class="help-block err" id="err-price"></div>
                              </div>

                               <div class="form-group">
                                 <label for='url' class='control-label'>URL Referensi</label>
                                 <input name='url' type='text' class='form-control' id='url'> 
                                 <div class="help-block err" id="err-url"></div>
                              </div>

                              <div class="form-group">
                                 <label for='body' class='control-label'>Keterangan</label>
                                 <textarea name='body' class='form-control' id='body' rows='3'></textarea>
                                 <div class="help-block err" id="err-body"></div>
                              </div>
                           </div>                                
                        </div>                
                     </div>
                     <input type="hidden" name="product_id" id="product_id">
                  </div>
               </form>
               <div class="modal-footer"></div>
            
         </div>
      </div>
   </div>