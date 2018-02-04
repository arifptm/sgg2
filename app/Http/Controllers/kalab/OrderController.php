<?php

namespace App\Http\Controllers\kalab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\user;
use Carbon\Carbon;
use DB;
use Excel;

class OrderController extends Controller
{
 	public function index($state = 'all'){         
    	return view('kalab.order.index', ['state'=> $state]);
    }

    public function list($state = 'all'){
    	$o = new Order();
    	$or = $o->where('status', '!=', 'draft')->orderBy('id', 'desc');
    	
    	$orders = ($state == 'all') ? $or : $or->where('status', $state);

    	return view('kalab.order.list', ['orders' => $orders->paginate(20) ]);
    }

    public function export(){
    	$users = User::notSuper()->orderBy('name', 'asc')->get();    	
    	return view('kalab.export.index',['users'=> $users]);
    }


    public function show($id){
    	return view('kalab.order.show',['id'=>$id]);
    }

    public function ajaxShow($id){
    	$order = Order::whereId($id)->with('product')->first();
        return view('kalab.order.block-show',['order' => $order]);
    }

    public function accept(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->status = 'accepted';
        $order->save();
        $msg = 'Selamat... Permintaan anda telah disetujui..';
        return response()->json(['msg'=>$msg]);
    }

    public function reject(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->status = 'rejected';
        $order->save();
        $msg = 'Maaf... Permintaan anda telah ditolak..';
        return response()->json(['msg'=>$msg]);
    }

    public function addNotes(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->notes = $request->notes;
        $order->save();
        $msg = 'Catatan telah ditambahkan..';
        return response()->json(['msg'=>$msg]);
    }

    public function updateNotes(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->notes = $request->notes;
        $order->save();
        $msg = 'Catatan telah diperbarui..';
        return response()->json(['msg'=>$msg]);
    }    

    public function excel(Request $request){
        $user_id = $request->user;
        $disposable = $request->disposable;
        $status = $request->status ?: '';
        $disposable = $request->disposable ?: '';
        $start = explode('-', $request->datestart);
        $end = explode('-', $request->dateend);
        
        $start = $start[2]."-".$start[1]."-".$start[0];
        $end = $end[2]."-".$end[1]."-".$end[0];
        $startdate = Carbon::parse($start);
        $enddate = Carbon::parse($request->enddate);
            
        $p = DB::table('orders')                
        ->whereBetween('orders.created_at', [$startdate, $enddate])
        ->where('orders.user_id', $user_id)                 
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('lineitems', 'orders.id', '=', 'lineitems.order_id')
        ->leftJoin('products','lineitems.product_id', '=', 'products.id')
        ->leftJoin('departments','users.department_id', '=', 'departments.id')
        ->select('orders.id','users.name as user_name', 'products.name as product_name', 'orders.created_at', 'lineitems.quantity', 'products.unit', 'lineitems.price as lineitem_price', 'products.price as product_price', 'products.disposable', 'lineitems.notes', 'orders.status', 'departments.name as department');

        ($status != '') ? $p = $p->where('orders.status', $status) : '';        
        ($disposable != '') ? $p = $p->where('products.disposable', $disposable) : '';
        
        $products = $p->orderBy('orders.id', 'desc')->get();
        //dd($products);
        $k = 0;
        foreach ($products as $key => $product) {
            $k++;
            $data[$key]['No'] = $k;                        
            $data[$key]['Nama Barang'] = $product->product_name;            
            $data[$key]['Jumlah'] = $product->quantity;
            $data[$key]['Satuan'] = $product->unit;
            $data[$key]['Harga Satuan'] = $product->product_price;
            $data[$key]['Jumlah Harga'] = $product->lineitem_price;
            $data[$key]['Ket./Spek.'] = $product->notes;
            $data[$key]['Tempat'] = $product->department;
        }

        $p_start = $request->datestart;
        $p_end = $request->dateend;
        Excel::create('Permintaan Barang LogistikTEDI.com', function($excel) use($data, $p_start, $p_end){
            $excel->setTitle('Daftar Permintaan Barang');
            $excel->sheet('Barang', function($sheet) use ($data, $p_start, $p_end){             
                $datacount = count($data);

                $sheet->fromArray($data);
                $sheet->appendRow(['Jumlah']);
                $sheet->mergeCells('A'.($datacount+2).':E'.($datacount+2));
                $sheet->cell('F'.($datacount+2), function($cell) use($datacount){
                    $cell->setValue('=SUM(F2:F'.($datacount+1).')');
                });
            
                $sheet->prependRow(['']);
                $sheet->prependRow(['Periode : '. $p_start.' - '.$p_end]);
                $sheet->prependRow(['Daftar Permintaan']);
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->cell('A1', function($cell) {
                    $cell->setFontSize(18);
                });             
                $sheet->cell('A2', function($cell) {
                    $cell->setFontSize(13);
                });                             
                $sheet->cell('A3', function($cell) {
                    $cell->setFontSize(4);
                });   
                $sheet->setBorder('A4:H'.($datacount+5), 'thin');            
            });



        })->export('xlsx');
    }

}
