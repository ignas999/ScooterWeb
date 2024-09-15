<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{

    //return views
    public function login() {
        return view('login');
    }

    //return views
    public function register(){
        return view('register');
    }

    public function userbalance(){
        $userinfo = User::find(auth()->user()->user_id);
        
        return view('balance')->with('userbalance', $userinfo->transactions);
    }

    public function getDashboard(){
        //check if there are expired orders
        self::CancelExpiredOrders(auth()->user()->user_id);

        $currentorder = app(OrderController::class)->getCurrentOrder();
        return view('dashboard')->with('currentOrder', $currentorder);
    }


    public function loginuser(Request $request)
    {   
    
        $formfields= $request->validate([
            
            'password' => 'required',
            'email' => 'required'


        ]);

        if (Auth()->attempt(['email' => $formfields['email'], 'password' => $formfields['password']])) {
            // Authentication was successful
            $request->session()->regenerate();
            return redirect('/dashboard')->with('message', 'sekmingai prisijungete');
        } else {
            return back()->with('message', 'blogi duomenys');
        }
    }  

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Sekmingai atsijungete');
    }

    public function store(Request $request){
        

        
        $formfields= $request->validate([
            'username' => 'required',
            'password' => ['required', 'confirmed'],
            'email' => 'required'

        ]);

        
        //hashiname

        $formfields['password'] = bcrypt($formfields['password']);

        
        
        
        $user = User::create($formfields);

           
        //auto login

        auth()->login($user);

        return redirect('/dashboard')->with('message' , 'Sekmingai uzsiregistravote!');

    
    }

    public function userprofilePage(){

        return view('updateprofileinfo');
    }

    public function updateprofileinfo(Request $request){

        $formfields= $request->validate([
        
            'phone' => ['required','numeric'],
            'email' => 'email'
    
    
        ]);

        //sanitize 
        $formfields['username'] = preg_replace('/[!@#$%^&*()_+\/]/', '', $request->username);

        
        //update phone
        User::where('user_id', auth()->user()->user_id)->update(['phone' => $formfields['phone']]);




        //update if usernameChanged
        if(auth()->user()->username != $formfields['username']){
            User::where('user_id', auth()->user()->user_id)->update(['username' => $formfields['username']]);
        }
        
        //update email if changed
        if(auth()->user()->email != $formfields['email'] && self::CheckIfEmailExists($formfields['email']) == false ){

            User::where('user_id', auth()->user()->user_id)->update(['email' => $formfields['email']]);

            self::logout($request);
        
        }
        




       

        return back()->with('message' , 'Informacija Atnaujinta');


    }

    public function CheckIfEmailExists($email){
        $email = User::where('email', $email)->first();
       
        if(is_null($email)){
            return false;
        }
        else{
            return true;
        }
    }

    // check for expired reservations , if found , cancel them
    public function CancelExpiredOrders($user_id) {

        

        //find all reservations of the user

        $reservations = Order::where('user_id', $user_id)->get();

        $currentDate =  Carbon::now()->format('Y-m-d H:i:00');
        foreach ($reservations as $reservation ) {
            
            if($reservation->status->name == 'Rezervuotas' && $reservation->end_date < $currentDate){
                
                // we found an expired order that was not cancelled

                //return money to balance

                //get the user profile for previous balance
                $user = User::where('user_id' , auth()->user()->user_id)->first();

                //return the balance
                User::where([['user_id' , auth()->user()->user_id]])->update(['balance' => $user['balance'] + $reservation->amount]);

                //change transport to available

                Transport::where('transport_id', $reservation->transport_id)->update(['status_id' => 1]);
            

                //set the order to cancelled

                Order::where([['user_id' ,auth()->user()->user_id], ['end_date', $reservation->end_date]])->update(['status_id' => 11]);
                
                

            }
        }
        
    }
}

