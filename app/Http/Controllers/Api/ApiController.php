<?php namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Auth;
use Input;
class apiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getRecipes()
	{
		$recipes= Recipe::all();

		if(!$recipes){
			return response()->json(['errors'=>array(['code'=>404,'message'=>'An error oaurred or list recipes is empty'])],404);
		}
		return response()->json(['status'=>'ok','data'=>$recipes],200);
		
	}
	
	public function userData($id){

		$user = User::findOrFail($id);

		if(!$user){
			return response()->json(['errors'=>array(['code'=>404,'message'=>'An error oaurred user is empty'])],404);
		}
		return response()->json(['status'=>'ok','data'=>$user],200);
	}

	public function authenticate(){

		$credentials = Input::only('email','password');

		if(Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json(['status'=>'ok','data'=>Auth::user()],200);
        }else{
        	return response()->json(['status'=>'error','data'=>'Invalid credentials'],404);
        }

	}


}
