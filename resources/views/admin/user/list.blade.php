<table class="table table-bordered" id="products-table">
   <thead>
      <tr>
         <th>Tanggal</th>
         <th>Nama</th>
         <th>Email</th> 
         <th>Departemen</th>
         <th>Peranan</th>
         <th>Aktif</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
      @if (count($users) > 0 )
         @foreach ($users as $user)
            <tr>
               <td class="hidden">
                  {{ $user->id }}
               </td>
               <td>
                  {{ $user->created_at }}
               </td>
               <td >
                  {{ $user->name }}
               </td>
               <td>
                  {{ $user->email }}
               </td>
               <td>
                  {{ $user->department['name'] or '-' }}
               </td>
               <td>
                  @foreach($user->roles as $role)
                   {{ $role->description }}{{ ($loop->index == count($user->roles) - 1 ) ? '' : ',' }}
                  @endforeach
               </td>
               <td>

                  {!! $user->verified == 1 ? '<span class="badge bg-green"><i class="fa fa-check"></i></span>' : '<span class="badge bg-orange"><i class="fa fa-times"></i></span>' !!}
               </td>               
               <td>
                  <div class='btn-group'>
                     <button class='btn btn-default btn-xs btn-edit-user' 
                        data-user_id='{{ $user->id }}' 
                        data-user_name='{{ $user->name }}' 
                        data-user_email='{{ $user->email }}' 
                        data-user_department_id='{{ $user->department_id }}' 
                        data-user_roles='{{ $user->roles->pluck("id") }}'
                        data-user_verified='{{ $user->verified }}' 
                     ><i class="glyphicon glyphicon-edit"></i></button>   
                     <button {{ $user->order->count() ? 'disabled' : '' }} class="btn-delete-user btn btn-danger btn-xs" data-id="{{ $user->id }}"><i class="glyphicon glyphicon-trash"></i></button>
                  </div>
                  
               </td>
            </tr>
         @endforeach
      @else
         <tr>
            <td colspan="7" class="h3">Tidak ada data</td>
         </tr>
      @endif
   </tbody>
</table>