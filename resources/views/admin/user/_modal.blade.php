{{-- Modal Create User--SHARE--Edit User}}
{{----------------------}}
<div class="modal modal-shared-user" tabindex="-1" role="dialog"> 
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-orange">
            <h4 class="no-margin" id="modal_title">Tambah Pengguna</h2>
         </div>
         <div class="modal-body">
            <form id="form-user">
               
               <div class="form-group">
                  <label for='name' class='control-label'>Nama User</label>
                  <input name='name' type='text' class='form-control' id='name'>                      
                  <div class="label label-danger err" id="err-create-user-name"></div>
               </div>

               <div class="form-group">
                  <label for='email' class='control-label'>Email</label>
                  <input name='email' type='text' class='form-control' id='email'>                      
                  <div class="label label-danger err" id="err-create-user-email"></div>
               </div>

               <div class="form-group">
                  <label for='password' class='control-label'>Password</label>
                  <input name='password' type='password' class='form-control' id='password'>                      
                  <div class="label label-danger err" id="err-create-user-password"></div>
               </div>

               <div class="form-group">
                  <label for='password_confirm' class='control-label'>Ulangi Password</label>
                  <input name='password_confirm' type='password' class='form-control' id='password_confirm'>                      
                  <div class="label label-danger err" id="err-create-user-password_confirm"></div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Jabatan</label>
                        <div>
                           @foreach ($roles as $role)
                              <div>
                                 <input type="checkbox" name="roles[]" class="form-check-input" id="role{{ $role->id }}" value="{{ $role->id }}">
                                 <label for="role{{ $role->id}}">{{ $role->name }}</label>
                              </div>
                           @endforeach
                        </div>
                        <div class="label label-danger err" id="err-create-user-role"></div>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="form-group" id="department_id"  style="display: none;">
                        <label class="control-label" for="department_id">Departemen</label>
                        <select name="department_id" class="form-control" >
                           <option value="">--Silakan pilih--</option>
                           @foreach($departments as $department)
                              <option value="{{ $department->id }}" >{{ $department->name }}</option>
                           @endforeach                        
                        </select>
                     <div class="label label-danger err" id="err-create-user-department_id"></div>
                     </div>
            
                     <div class="form-group" id="verified_wrapper" style="display:none;">  
                         <div class="icheck">                          
                             <input type="checkbox" name="verified" value="1" class="form-check-input" id="verified">
                             <label for='verified' class= 'control-label'>Status Aktif</label>
                         </div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <input type="hidden" name="id" id="user_id">
                  <button class="btn btn-primary btn-share-submit">Simpan</button>

               </div>                 
            </form>
           
         </div>
      </div>
   </div>
</div>

{{-- Modal Show Detail User}}
{{----------------------}}
   <div class="modal modal-show-user" role="dialog"> 
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body">                 
               <div class="row">
                  <div class="col-sm-6">                        
                     <div class="h3"><div id="show-title"></div></div>
                     <ul class="list-group">
                        <li class="list-group-item"><b>Tanggal terdaftar :</b> <span id="show-created_at"></span></li>
                        <li class="list-group-item"><b>Nama :</b> <span id="show-name"></span></li>
                        <li class="list-group-item"><b>Email :</b> <span id="show-email"></span></li>
                        <li class="list-group-item"><b>Departemen :</b> <span id="show-department"></span></li>
                        <li class="list-group-item"><b>Peranan :</b> <span id="show-role"></span></li>                        
                     </ul>
                  </div>

               </div>                  
            </div>
         </div>
      </div>
   </div>