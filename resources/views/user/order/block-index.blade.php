@if(count($orders) > 0 )          
          <table class="table table-bordered table-condensed">
            <thead>
              <tr>          
                <th style="width: 80px">Tanggal</th>
                <th>Nama Barang</th>
                <th class="text-right">Qty</th>
                <th>Satuan</th>
                <th>Catatan</th>
                <th class="text-center">Status</th>                
                <th class="text-right">Aksi</th>
              </tr>
            </thead>

              @foreach ($orders as $order)
                @foreach($order->product as $k => $lineitem)
                  <tr>
                    @if ($k == 0)
                      <td rowspan="{{ $order->product->count() }}">
                        {{ \Carbon\carbon::parse($order->created_at)->format('d-m-y') }}
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
                    <td>
                      {{ $lineitem->pivot->notes ? $lineitem->pivot->notes : '-' }}
                    </td>                    
                    @if ($k == 0)
                      <td class="text-center" rowspan="{{ $order->product->count() }}" >
                        {!! ($order->status == 'draft') ? '<div class="badge">Rencana</div>' : '' !!}
                        {!! ($order->status == 'pending') ? '<div class="badge">Menunggu</div>' : '' !!}
                        {!! ($order->status == 'accepted') ? '<div class="badge bg-green">Diterima</div>' : '' !!}
                        {!! ($order->status == 'rejected') ? '<div class="badge bg-red">Ditolak</div>' : '' !!}
                      </td>
                      <td rowspan="{{ $order->product->count() }}" class="text-right">
                        <div class='btn-group'>
                          <a href="/orders/show/{{ $order->id }}" class="{{ ($order->status == 'approved' OR $order->status == 'rejected' ) ? 'disabled' : '' }} btn btn-default btn-xs btn-edit-order" >    
                                <i class="fa fa-edit"></i>
                          </a>
                          <button class="{{ ($order->status == 'approved' OR $order->status == 'rejected' ) ? 'disabled' : '' }} btn btn-danger btn-xs btn-delete-order" data-order_id="{{ $order->id }}"><i class='fa fa-trash'></i></button>
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

