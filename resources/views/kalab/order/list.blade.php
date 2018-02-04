@if(count($orders) > 0 )          
          <table class="table table-bordered table-stripped">
            <thead>
              <tr>          
                <th style="width: 80px">Tanggal</th>
                <th>Nama Laboran</th>
                <th>Nama Barang</th>
                <th class="text-right">Qty</th>
                <th>Satuan</th>
                <th class="text-right">Harga @</th>
                <th class="text-right">Jumlah</th>
                <th>Catatan</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            
              @foreach ($orders as $order)
                @foreach($order->product as $k => $lineitem)
                  <tr>
                    @if ($k == 0)
                      <td rowspan="{{ $order->product->count() }}">
                        {{ \Carbon\carbon::parse($order->created_at)->format('d-m-y') }}
                      </td>                  
                    	<td rowspan="{{ $order->product->count() }}">
                      	{{ $order->user->name }}
                    	</td>
                    @endif
                    <td>
                      <a href="#" data-slug="{{ $lineitem->slug }}" class="product-name">{{ $lineitem->name }}</a>
                    </td>
                    <td class="text-right">
                      {{ $lineitem->pivot->quantity }}
                    </td>
                    <td>
                      {{ $lineitem->unit }}
                    </td>
                    <td class="text-right">
                      {{ number_format($lineitem->price,0,',','.') }}
                    </td>
                    <td class="text-right">
                      {{ number_format($lineitem->pivot->price,0,',','.') }}
                    </td>
                    @if ($k == 0)
                      <td rowspan="{{ $order->product->count() }}">
                        {{ $order->notes or '-'}}
                      </td>                                            
                      <td class="text-center" rowspan="{{ $order->product->count() }}">                        
                        @if($order->status == 'pending')
                          <a href="/kalab/orders/show/{{ $order->id }}" class="btn btn-xs btn-primary"><i class="fa fa-play"></i> Proses</a>
                        @elseif($order->status == 'accepted')
                          <div class="badge bg-green">Disetujui</div>
                        @elseif($order->status == 'rejected')
                          <div class="badge bg-red">Ditolak</div>
                        @endif
                      </td>                      

                    @endif
                  </tr>
                @endforeach              
              @endforeach
            </table> 
            <div class="">{{ $orders->links() }}</div>
              
@else
    <p><div class="h4">
        Tidak ada data ..!
    </div></p>
@endif

