@if(count($orders) > 0 )          
          <table class="table table-bordered table-condensed">
            <thead>
              <tr>          
                <th style="width: 80px">Tanggal</th>
                <th>Nama Laboran</th>
                <th>Nama Barang</th>
                <th class="text-right">Qty</th>
                <th>Satuan</th>
                <th>Catatan</th>
                <th class="text-center">Status</th>
                <th>Aksi</th>
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
                    @if ($k == 0)
                      <td rowspan="{{ $order->product->count() }}">
                        {{ $order->notes }}
                      </td>                                            
                      <td class="text-center" rowspan="{{ $order->product->count() }}">                        
                        @if($order->status == 'pending')
                          <a href="/admin/orders/show/{{ $order->id }}" class="btn btn-xs btn-primary"><i class="fa fa-play"></i> Proses</a>
                        @elseif($order->status == 'accepted')
                          <div class="badge bg-green">Approved</div>
                        @elseif($order->status == 'rejected')
                          <div class="badge bg-red">Rejected</div>
                        @endif
                      </td>                      
                      
                      <td rowspan="{{ $order->product->count() }}">
                        <div class='btn-group'>
                          <a href="/admin/orders/show/{{ $order->id }}" class="{{ ($order->status == 'accepted' OR $order->status == 'rejected' ) ? '' : 'disabled' }} btn btn-default btn-xs btn-edit-request" >    
                                <i class="fa fa-edit"></i>
                          </a>
                          <button  class="btn btn-danger btn-xs btn-delete-lineitem" data-id="{{ $order->id }}" {{ ($order->status == 'accepted' OR $order->status == 'rejected' ) ? 'disabled' : '' }}><i class='fa fa-trash'></i></button>
                        </div>                      
                      </td>                  

                    @endif
                  </tr>
                @endforeach              
              @endforeach

          </table>
@else
    <span class="h4">Tidak ada data permintaan..!</span>
@endif

