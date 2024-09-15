<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Transport;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use function PHPUnit\Framework\isNull;


class OrderController extends Controller
{
    //display order
    public function DisplayOrder(Request $request) {
        

        //get a single listing but first ,check if its free(not in use)
        
        $transport = Transport::with(['category','location','status'])->find($request->transportid);
        
        if(is_null($transport) || $transport->status->status_id != 1){
            return redirect('/models');
            
        }
        else{
            return view('orders.singlemodel')->with(['transport' => $transport]);
        }
    }

    public function StoreOrder(Request $request) {
        
        $formfields= $request->validate([
        
            'start_date' => 'required',
            'end_date' => 'required'
    
    
        ]);

        
        
        $user_id = auth()->user()->user_id;

        //formatting dates 
        $startdatefinal = Carbon::parse($formfields['start_date']);
        $finishdatefinal = Carbon::parse($formfields['end_date'])->addHour();
       
        

        if($user_id == session('user_id') && self::DateChecker($startdatefinal, $finishdatefinal) ){

            $formfields['status_id'] =  9;
            $formfields['user_id'] = $user_id;
            $formfields['transport_id'] = session('transport_id');
            $formfields['amount'] = self::Price($startdatefinal, $finishdatefinal, session('transport_id'));
            

            $formfields['start_date'] = $startdatefinal->format('Y-m-d H:i:00');
            $formfields['end_date'] = $finishdatefinal->format('Y-m-d H:i:00');
            
            //check if there is enough balance 

            if(self::AdjustAccountBalance($user_id , $formfields['amount']) == true){

                Order::create($formfields);

                //change statuses to Uzimtas
                Transport::where('transport_id' , session('transport_id'))->update(['status_id'=>'2']);
                return redirect('/dashboard')->with('message', 'Uzsakymas rezervuotas , jį  pamatyti galite uzsakymuose');

            }
            else{

                $balance =  User::where('user_id' ,$user_id)->get('balance')->first();
                $balance = $balance['balance'];


                return back()->with('message', 'neuztenka pinigu saskaitoje. uzsakymo kaina: '. $formfields['amount'] 
                . 'eur ,o jusu saskaitoje: ' . $balance .' eur' );
            }
            



        }
        else{
            return back()->with('message', 'klaida pasirenkant data');
        }
    }

    public function AdjustAccountBalance($userid , $price){
        $user = User::where('user_id' ,$userid)->first();
        $userCurrentBalance = $user['balance'];

        //first check the balance

        if($userCurrentBalance - $price >= 0){ 

            //update the balance 
            User::where('user_id' , $userid)->update(['balance' => $userCurrentBalance - $price]);

            return true;
        }
        else{

           return false;
           
        }

        

    }
    public function DateChecker($startdate, $finishdate){

    $currentDate = Carbon::now()->subMinute()->format('Y-m-d H:i:00');

        
        if($startdate < $finishdate && $startdate >= $currentDate ){
            return true;
        }
        else{

            
            return false;
        }
    }

    public function Price($startdate, $finishdate, $transport_id) {


        $totalhours = $finishdate->diff($startdate)->format('%H');
        $totalhours = ltrim($totalhours, '0');
        if($totalhours == ''){
            $totalhours = 0;
        }

        $totaldays = $finishdate->diff($startdate)->format('%d');
        
        
       

        $transportPrice = Transport::find($transport_id);
        
        
        $transportPrice = number_format(($totalhours+($totaldays * 24)) * $transportPrice->price, 2) ;

      
        

        return $transportPrice;
    }

    public function getCurrentOrder() {
        
        $currentDate =  Carbon::now()->format('Y-m-d H:i:00');
        $user_id = auth()->user()->user_id;

        

        // neveike nes format("'Y-m-d H:i:00'")

        //get orders that are currently happening
        $order = Order::with(['transport','status','user'])->where([
            ['user_id', $user_id],
            ['end_date', '>=', $currentDate],
            ['start_date', '<=', $currentDate],
            ['status_id', '!=', 10]])
            ->first();

      

           
        //if therea are orders ->do the below
        if(!is_null($order)){
           
                    //timeleft calculation
                    
                    $currentDate = Carbon::parse($currentDate);
                    $orderdatefinish =  Carbon::parse($order->end_date);
                    $order['Timeleft']= ltrim($orderdatefinish->diff($currentDate)->format('%H val %i min'));

                    $order['status'] = 'current';
            return $order;
        }
       
        
        // try searching for upcoming if we found nothing
        $order = Order::with(['transport','status','user'])->where([
            ['user_id', $user_id],
            ['end_date', '>=', $currentDate],
            ['start_date', '>=', $currentDate],
            ['status_id', '!=', 10]])
            ->first();
        
        //check if we found upcoming
        if(!is_null($order)){
            $order['status'] = 'upcoming';
            return $order;
        }

        //if there are no active or future Order
        else{
            
            $order['status'] = 'empty';
            return $order;
        }
        
        

        
       
        
    }

    public function getAllOrders(){
        
        $orders = Order::with(['transport', 'status'])->where('user_id' ,auth()->user()->user_id)->simplePaginate(6);
        
        return $orders;
    }

    public function OrderHistory()  {
        return view('orders.alluserorders')->with(['orders' => self::getAllOrders()]);
    }

    public function CancelOrder(Request $request){

       

        //check if the order belongs to a user
        if(self::CancelOrderChecker($request->id) == true){

            //update order status
            Order::where([['user_id' ,auth()->user()->user_id], ['order_id', $request->id]])->update(['status_id' => 10]);

            //get the order info
            $order = Order::where([['user_id' ,auth()->user()->user_id], ['order_id', $request->id]])->first();
           


            //return money to balance

                //get the user profile for previous balance
                $user = User::where('user_id' , auth()->user()->user_id)->first();

                //update the balance
                User::where([['user_id' , auth()->user()->user_id]])->update(['balance' => $user['balance'] + $order['amount']]);

            
            //change transport to available

            Transport::where('transport_id', $order['transport_id'])->update(['status_id' => 1]);
            

            return back()->with('message', 'Sekmingai atsaukta');
        }
        else{
            return back('/dashboard')->with('message', 'neegzistuoja') ;    
          }
    }

    

    public function CancelOrderChecker($id){
        
        $user_id= auth()->user()->user_id;
        $order = Order::where([['user_id' ,$user_id], ['order_id', $id]])->get();
        if(isNull($order)){
            return true;
        }
        else{
            return false;
        }
    }
}
