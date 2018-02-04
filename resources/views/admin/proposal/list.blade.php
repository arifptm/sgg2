@if(count($products) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Gambar</th>
				<th>Nama Barang</th>
				<th>Keterangan</th>
				<th>HP</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			
				@foreach ($products as $product)
					<tr>
						<td>{{ $product->id }}</td>
						<td><img src="/imagecache/tiny/{{ $product->name }}" alt=""></td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->harga }}</td>
						<td>{{ $product->keterangan }}</td>
						<td>{{ $product->name }}</td>
						<td>
		                  	<div class='btn-group'>
		                     	<button class='btn btn-default btn-xs btn-edit-product' data-id='{{ $product->id }}' data-name='{{ $product->name }}'><i class="glyphicon glyphicon-edit"></i></button> 
		                     	<button class="btn-delete-product btn btn-danger btn-xs" data-product_id = "{{ $product->id}}"><i class="glyphicon glyphicon-trash"></i></button>
		                  	</div>            						
						</td>
					</tr>
				@endforeach
			
		</tbody>
	</table>
@else
	<div class="h3 no-margin"><div class='alert alert-info'>Tidak ada data..!</div></div>
@endif