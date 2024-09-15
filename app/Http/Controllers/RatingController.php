<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Transport;
use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class RatingController extends Controller
{
    public function ratingspage(){
        $userratings = self::getallRatingsofuser();


        return view('ratings.ratings')->with('Ratings' ,$userratings);
    }


    public function getallRatingsofuser(){

       
    $ratings = Rating::where('user_id' , auth()->user()->user_id)->get();
        
    return $ratings;

    }

    public function addratingpage($id){

        //check if there is a review already made by the user on the vehicle

        $user_id = auth()->user()->user_id;
        $rating = Rating::where([['user_id', $user_id],['transport_id' ,$id]])->first();
        
        if(is_null($rating)){
             //get vehicle that user  wants to rate 
            $transport = Transport::find($id);
            return view('ratings.addrating')->with('transport' , $transport);
            
        }
        else{
            
             return back()->with('message' , 'jau esate palikęs įvertinimą');
        }


       
    }

    public function storerating(Request $request){

        $formfields['comment'] = $request->comment;
        $formfields['rating_score'] = $request->rating;
        $formfields['transport_id'] = $request->transport;
        $formfields['user_id'] = auth()->user()->user_id;


        if($formfields['comment'] == null){
            $formfields['comment'] = "";
        }
        Rating::create($formfields);

        return redirect('ratings')->with('message', 'Sekmingai ivertinote');

       
        

    }


    public function getRatingModel($id){

        //get single ratings of a model

        $ratingsofmodel = Rating::with('user')->where('transport_id', $id)->simplePaginate(2);
        $ratingsofmodel_count = Rating::with('user')->where('transport_id', $id)->count();

        $modelinfo = Transport::find($id);
        return view('ratings.single_transport_ratings')->with(['ratings'=>  $ratingsofmodel,'ratings_count' => $ratingsofmodel_count, 'transport' => $modelinfo]);
    }

    public static function getRandomRating(){
        $random = rand(1,3);

        $ratings = Rating::where('comment', '!=', '')->with(['transport','user'])->get();
        
        return $ratings[$random];
        }

    //delete rating 
    public function deleterating($id) {
        $rating = Rating::find($id);
        
        
        if($rating->user_id == auth()->user()->user_id){
            $rating->delete();
            return redirect('ratings')->with('message', 'Įvertinimas ištrintas');
        }
        else{
            return redirect('/dashboard');
        }
        
    }
}
