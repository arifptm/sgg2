         <div class="col-md-4">           
            
            <div class="box box-primary">
                      
               <div class="box-header with-border">
                  <h3 class="box-title">Rencana Permintaan Barang</h3>
               </div>         
               <div class="box-body">
               @if(count($order_inprogress) > 0) 
                  <table class="table table-striped" id="products-table">
                     <thead>
                        <tr>
                           <th class="text-right">Qty</th>
                           <th>Unit</th> 
                           <th>Nama Barang</th> 
                           <th class="text-right"></th>
                        </tr>
                     </thead>  
                                                               
                        @foreach($order_inprogress->product as $item)
                           <tr>

                              <td class="text-right">
                                 {{ $item->pivot->quantity }}
                              </td>

                              <td>
                                 {{ $item->unit }}
                              </td>
                              <td>
                                 <a href="#" data-slug="{{ $item->slug }}" class="product-name">{{ $item->name }}</a>
                              </td>

                              <td>
                                 <div class="dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                       <i class="glyphicon glyphicon-option-vertical"></i>
                                    </div>

                                    <ul class="dropdown-menu drop-menu-sm dropdown-menu-right">
                                       <li>
                                          <a href="#" class='text-blue dropdown-item btn-edit-lineitem'                                           
                                          data-lineitem_id = "{{ $item->pivot->id }}"
                                          data-product_title="{{ $item->name }}" 
                                          data-product_image="{{ $item->image or 'noimage.gif' }}"
                                          data-lineitem_quantity="{{ $item->pivot->quantity }}" 
                                          data-product_unit="{{ $item->unit }}"
                                          data-product_notes="{{ $item->pivot->notes }}">
                                          <i class='fa fa-edit'></i> Ubah
                                          </a>
                                       </li>

                                       <li>
                           			      <a href="#" class='text-red dropdown-item btn-delete-lineitem' data-order_id="{{ $order_inprogress->id }}" data-product_id="{{ $item->id }}" ><i class='fa fa-trash'></i> Hapus</a>
                                       </li>
                                    </ul>
                                 </div>
                              </td>
                           </tr>
                        @endforeach                     
                  </table>
               </div>
               <div class="box-footer">
               <a href="/orders/show/{{$order_inprogress->id}}" class="btn btn-primary">Lanjutkan...</a>
               </div>
               @else               
                  <h5>Tidak ada data permintaan barang!</h5>
               @endif

               
            </div>         
         </div>        
