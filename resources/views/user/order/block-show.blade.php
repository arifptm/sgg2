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
                    <div class="label label-info">Menunggu persetujuan</div>
                  @elseif($order->status == 'approved') 
                    <div class="label label-green">Disetujui</div>
                  @elseif($order->status == 'rejected') 
                    <div class="label label-red">Ditolak</div>
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
                <th>Aksi</th>
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
                      {{ number_format($lineitem->pivot->aprice,0,',','.') }}
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

                     <div class="dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                           <i class="glyphicon glyphicon-option-vertical"></i>
                        </div>

                        <ul class="dropdown-menu drop-menu-sm dropdown-menu-right">
                           <li>
                              <a href="#" class="text-blue dropdown-item btn-edit-lineitem {{ ($order->status == 'approved' OR $order->status == 'rejected' ) ? 'disabled' : '' }}" 
                              data-lineitem_id = "{{ $lineitem->pivot->id }}"
                              data-lineitem_quantity="{{ $lineitem->pivot->quantity }}" 
                              data-lineitem_notes="{{ $lineitem->pivot->notes }}" 
                              data-product_unit="{{ $lineitem->unit }}"
                              data-product_title="{{ $lineitem->name }}" 
                              data-product_image="{{ $lineitem->image or 'noimage.gif' }}">                                          
                              <i class='fa fa-edit'></i> Ubah
                              </a>
                           </li>
                           <li>
                          <a href="#" class="text-red dropdown-item btn-delete-lineitem {{ ($order->status == 'approved' OR $order->status == 'rejected' ) ? 'disabled' : '' }}" data-order_id="{{ $order->id }}" data-product_id="{{ $lineitem->id }}"><i class='fa fa-trash'></i> Hapus</a>
                           </li>
                        </ul>
                     </div>

                    </td>                  
                    
              </tr>
            @endforeach
        	</tbody>
	        <tfoot>
            <tr>
            	<th colspan="5" class="text-right">Jumlah</th>
            	<th class="text-right">{{ number_format(array_sum($subtotal),0,',','.') }}</th>
            	<th colspan="2"></th>
            </tr>
          </tfoot>
        </table> 
      </div>
      @if($order->status == 'draft') 
        <div class="box-footer">
      	   <button class='btn btn-primary' id="btn-checkout" data-order_id="{{ $order->id }}">Kirim ke Admin</button>
     	  </div>
      @endif
