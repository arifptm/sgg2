@if(count($products) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="hidden">ID</th>
				<th>Gambar</th>
				<th>Nama Barang</th>
				<th>Satuan</th>
				<th>Keterangan</th>
				<th class="text-right">Harga</th>
				<th class="text-center">HP</th>
				<th class="text-center">Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			
				@foreach ($products as $product)
					<tr>
						<td class="hidden">{{ $product->id }}</td>
						<td><img src="/imagecache/tiny/{{ $product->image or 'noimage.gif' }}" alt=""></td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->unit }}</td>
						<td>{{ str_limit($product->body) ?: '-' }}</td>
						<td class="text-right">{{ number_format($product->price,0,',','.') }}</td>
						<td class="text-center">
						    @if($product->disposable)
						    	{!! $product->disposable == 'hp' ? '<span class="badge bg-green"><i class="fa fa-check"></i></span>' : '<span class="badge bg-orange"><i class="fa fa-times"></i></span>' !!}
						    @else
						    	-
						    @endif
						</td>
						<td class="text-center">
						    @if($product->status == 'pending')
						    	<div><button class="btn btn-primary btn-xs" id="btn-process-proposal" data-data="{{ e($product) }}""> <i class="fa fa-play"></i> Proses</button></div>
						    @elseif($product->status == 'approved')
						    	<div class="badge bg-green">Approved</div>
						    @elseif($product->status == 'rejected')
						    	<div class="badge bg-red">Rejected</div>
						    @endif
						</td>						
						<td>
		                  	<div class='btn-group'>
		                     	<button {{ ($product->status == 'pending') ? 'disabled' : '' }} class='btn btn-default btn-xs btn-edit-product' data-data='{{ $product }}'><i class="glyphicon glyphicon-edit"></i></button> 
		                     	<button {{ ($product->status == 'pending') ? 'disabled' : '' }} class="btn-delete-product btn btn-danger btn-xs" data-product_id = "{{ $product->id}}"><i class="glyphicon glyphicon-trash"></i></button>
		                  	</div>            						
						</td>
					</tr>
				@endforeach
			
		</tbody>
	</table>
@else
	<div class="h3 no-margin"><div class='alert alert-info'>Tidak ada data..!</div></div>
@endif