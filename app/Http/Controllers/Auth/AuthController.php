<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Mail;
use Auth;


class AuthController extends Controller {
	
	public function __construct()
	{
				
		$this->middleware('guest',['except' => ['logout', 'getLogout']]);
	}

	//register functions
	public function registerPost(){
		
		$postData = Input::all();

	    $rules = [
	      'name' => 'required|max:22|min:4',
	      'email' => 'required|email|unique:users',
	      'password' => 'required',
	      'password_confirmation' => 'required|same:password'
	    ];


     	$validator = Validator::make($postData, $rules);

		if ($validator->fails()) {
		      
		    return redirect('/auth/register')->withInput()->withErrors($validator);
		}
    	else {

    		$confirmation_code = str_random(30);
    		$user= new User();
    		$user->name = Input::get('name');
    		$user->email = strtolower(Input::get('email'));
    		$user->password = bcrypt(Input::get('password'));
    		$user->confirm_token = $confirmation_code;
    		$result = $user->save();

    		if($result){

    			Mail::send('emails.verify',array('code' => $confirmation_code,'user'=>$user) , function($message) use ($user){

    				$message->from('admin@cookingisfun','Cooking Is Fun');
            		$message->to($user->email, $user->name)->subject('Verify your email address');
        		});

    			
        		return redirect('/home')->with('message',trans('messages.register.ok'));
    		}else{
    			return redirect('/home')->with('message_warning',trans('messages.register.fail'));
    		}
     			
    	}
		
	}

	public function registerGetView(){

		return view('auth.register');
	}

	public function registerVerify($code){

		$user = User::where('confirm_token','=',$code)->first();
		if($user){

			$user->active=1;
			$user->save();

			return redirect('/home')->with('message',trans('messages.register.confirm.ok',['name'=>$user->name]));
		}
		return redirect('/home')->with('message_warning',trans('messages.register.confirm.fail'));
		
	}

	//login functions
	public function loginPost(){
		//return Input::all();

		$postData = Input::all();

	    $rules = [
	      
	      'email' => 'required|email|',
	      'password' => 'required'
	      
	    ];

     	$validator = Validator::make($postData, $rules);

		if ($validator->fails()) {
		      
		    return redirect('/auth/login')->withInput()->withErrors($validator);

		}else{
			
			$credentials = [

				'email' => Input::get('email'), 
				'password' => Input::get('password'),
				'active' => 1
			];

			if(Auth::attempt($credentials, Input::has('remember'))) {
            
            	return redirect('/home')->with('message',trans('messages.login.ok'));
            	

        	}else{
        		return redirect('/home')->with('message_warning',trans('messages.login.fail'));
        	}
		}


	}

	public function loginGetView(){

		return view('auth.login');
	}

	public function logout(){

		Auth::logout();

		return redirect('/home')->with('message','Logout');
	}

	


}
