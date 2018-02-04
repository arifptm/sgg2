<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Departemen</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($departments as $department)
			<tr>
				<td>{{ $department->id }}</td>
				<td>{{ $department->name }}</td>
				<td>
                  	<div class='btn-group'>
                     	<button class='btn btn-default btn-xs btn-edit-department' data-id='{{ $department->id }}' data-name='{{ $department->name }}'><i class="glyphicon glyphicon-edit"></i></button> 
                     	<button {{ $department->user->count() ? 'disabled' : '' }} class="btn-delete-department btn btn-danger btn-xs" data-department_id = "{{ $department->id}}"><i class="glyphicon glyphicon-trash"></i></button>
                  	</div>            						
				</td>
			</tr>
		@endforeach
	</tbody>
</table>