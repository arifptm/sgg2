      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <dl class="dl-horizontal no-margin">
            	<dt>Tanggal</dt>
            	<dd>{{ \Carbon\carbon::parse($order->updated_at)->format('d-m-y') }}</dd>
            	<dt>Nama</dt>
            	<dd>{{ $order->user->name }}</dd>
            	<dt>Departemen</dt>
            	<dd>{{ $order->user->department->name }}</dd>
            </dl>
          </div>
          <div class="col-md-6">
            
              @if($order->status != 'draft') <label>Status Permintaan</label> @endif
              <div class="h4 no-margin">
                  @if($order->status == 'pending') 
                    <div class="badge bg-orange">Menunggu persetujuan</div>
                  @elseif($order->status == 'accepted') 
                    <div class="badge bg-green">Disetujui</div>
                  @elseif($order->status == 'rejected') 
                    <div class="badge bg-red">Ditolak</div>
                  @endif
                </div>
              </div>
            
          </div>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered" id="order-{{ $order->id }}">     
        	<thead>            
              <tr>          
                <th style="width: 40px">No</th>
                <th>Nama Barang</th>
                <th class="text-right">Qty</th>
                <th>Satuan</th>
                <th class="text-right">Harga @</th>
                <th class="text-right">Jumlah</th>
                <th>Spek./Merk/Katalog</th>
                <th>Tempat</th>
                
              </tr>
        	</thead>
        	<tbody>
        		@foreach ($order->product as $lineitem)
        		  <tr>
                    
                    <td>
                    {{ $loop->iteration }}    
                    </td>                  
                    
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
                      {{  number_format($subtotal[]=$lineitem->pivot->price,0,',','.') }}
                    </td>
                    <td>
                      @if(trim($lineitem->pivot->notes) != '')
                        {{ $lineitem->pivot->notes }}
                      @else - @endif
                    </td>       
                    <td>
                      {{ $order->user->department->name }}
                    </td>
              </tr>
            @endforeach
        	</tbody>
	        <tfoot>
            <tr>
            	<th colspan="5">

                <span class="pull-right">Jumlah</span></th>
            	<th class="text-right">{{ number_format(array_sum($subtotal),0,',','.') }}</th>
            	<th colspan="2"></th>
            </tr>
          </tfoot>
        </table> 
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-6">
      	      @if($order->status == 'pending')
             <button class='btn btn-primary' id="btn-accepted" data-order_id="{{ $order->id }}"><i class="fa fa-check"></i> TERIMA</button>
      	     <button class='btn btn-danger' id="btn-rejected"><i class="fa fa-close"></i> TOLAK</button>
             @endif
              <span class="pull-right">
                @if ($order->notes == '')
                  <button class='btn btn-primary ' id="btn-create-notes"><i class="fa fa-plus"></i> Tambah Catatan</button>
                @else
                  <button class='btn btn-primary ' id="btn-edit-notes" data-notes="{{ e($order->notes) }}"><i class="fa fa-edit"></i> Edit Catatan</button>
                @endif
              </span>
             

           </div>
           <div class="col-md-6">
            <label>Catatan:</label>
            <div class="well well-sm">{!! $order->notes ? nl2br($order->notes) : 'Tidak ada' !!}</div>
           </div>
     	  </div>
      </div>
      @include('kalab.order.modal-notes')
