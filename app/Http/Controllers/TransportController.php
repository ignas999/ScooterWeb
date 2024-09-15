<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\Category;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function getTransports(Request $request){



        if($request->categoryid != null){

            // if there is a categoryID present in url return all transport with that category
            return $this->TransportsByCategoryID($request);

        }
        else{

            //return all transport that is available
             return $this->allTransports();

        }



    }

    public function TransportsByCategoryID(Request $request){
        $available_transports = Transport::with(['status','category'])->where('category_id' , $request['categoryid'])->simplePaginate(4);
        $categories = Category::all();
        $available_transports_count = Transport::with(['status','category'])->where('category_id' , $request['categoryid'])->count();



        return view('orders.allmodels')->with([
            'available_transports' => $available_transports ,
            'categories' =>  $categories,
            'transport_count' => $available_transports_count]);
    }

    public function allTransports() {
        $available_transports = Transport::with(['status','category'])->simplePaginate(4);
        $categories = Category::all();
        $available_transports_count = Transport::with(['status','category'])->count();


        return view('orders.allmodels')->with([
            'available_transports' => $available_transports ,
            'categories' =>  $categories,
            'transport_count' => $available_transports_count]);
    }
}
