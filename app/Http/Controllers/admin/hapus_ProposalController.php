<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;

class ProposalController extends Controller
{
    public function index(){       
    	return view('admin.proposal.index');
    }

    public function list(){
    	$proposal = Product::orderBy('name','asc')->verified()->paginate(20);
    	return view('admin.proposal.list',['proposals'=>$proposals]);        
    } 
}
