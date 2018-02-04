   
   {{-- Modal Create --}}
   {{------------------}}
   
   <div class="modal" tabindex="-1" role="dialog" id="modal-create-department"> 
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-orange">
               <h4 class="no-margin">Tambah Departemen</h2>
            </div>

            <div class="modal-body">  
               <form id="form-create-department">
                  <div class="form-group">
                     <label for="name" class="control-label" >Nama Departemen</label>
                     <input type="text" name="name" id="name" class="form-control">
                     <div class="label label-danger err" id="err-create-department-name"></div>
                  </div>        
                  
                  <div class="form-group">
                     <button class="btn btn-primary" id="btn-store-department">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>


   {{-- Modal Edit --}}
   {{------------------}}
   <div class="modal" tabindex="-1" role="dialog" id="modal-edit-department"> 
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-orange">
               <h4 class="no-margin">Edit Departemen</h2>
            </div>

            <div class="modal-body">  
               <form id="form-edit-department">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                     <label for="name" class="control-label" >Nama Departemen</label>
                     <input type="text" name="name" id="name" class="form-control">
                     <div class="label label-danger err" id="err-edit-department-name"></div>
                  </div>        
                  
                  <div class="form-group">
                     <button class="btn btn-primary" id="btn-update-department">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>   
