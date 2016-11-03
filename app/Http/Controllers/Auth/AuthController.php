<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Validator;
use Input;
use Mail;
use Auth;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class AuthController extends Controller {

	

    //use AuthenticatesAndRegistersUsers;
	
	public function __construct()
	{
				
		$this->middleware('guest',['except' => ['logout', 'getLogout']]);
	}

	//register functions
	public function registerPost(){
		
		$postData = Input::all();

	    $rules = [
	      'name' => 'required|max:22|min:6',
	      'email' => 'required|email|unique:users',
	      'password' => 'required',
	      'password_confirmation' => 'required|same:password'
	    ];

	    $messages = [
	     'name.required'=>'Enter required name',
	     'name.max'=>'Max name 30',
	     'name.min'=>'Min name 6',
         'email.required' => 'Enter email address',
         'email.email' => 'Invalid email format',
         'email.unique' => 'Email exixts',
         'password.required' => 'You need a password',
         'password_confirmation.required' => 'Email confirm is required',
         'password_confirmation.same' => 'Email confirm is not equal'
     	];

     	$validator = Validator::make($postData, $rules,$messages);

		if ($validator->fails()) {
		      
		    return redirect('/auth/register')->withInput()->withErrors($validator);
		}
    	else {

    		$confirmation_code = str_random(30);
    		$user= new User();
    		$user->name = Input::get('name');
    		$user->email = Input::get('email');
    		$user->password = bcrypt(Input::get('password'));
    		$user->confirm_token = $confirmation_code;
    		$result = $user->save();

    		if($result){

    			Mail::send('emails.verify',array('code' => $confirmation_code,'user'=>$user) , function($message) use ($user){

    				$message->from('admin@cookingisfun','Cooking Is Fun');
            		$message->to($user->email, $user->name)->subject('Verify your email address');
        		});

    			
        		return redirect('/home')->with('message','Ok register successful!! check your email for confirmation');
    		}else{
    			return redirect('/home')->with('message_warning','Error on registration');
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

			return redirect('/home')->with('message','Ok '.$user->name.' su cuenta ya esta activada, inicie session para empezar.');
		}
		return redirect('/home')->with('message_warning','Error la confirmacion es fallida');
		
	}

	//login functions
	public function loginPost(){
		//return Input::all();

		$postData = Input::all();

	    $rules = [
	      
	      'email' => 'required|email|',
	      'password' => 'required'
	      
	    ];

	    $messages = [
	     
         'email.required' => 'Enter email address',
         'email.email' => 'Invalid email format',
         'password.required'=>'Enter required name'
         
     	];

     	$validator = Validator::make($postData, $rules,$messages);

		if ($validator->fails()) {
		      
		    return redirect('/auth/login')->withInput()->withErrors($validator);

		}else{
			
			$credentials = [

				'email' => Input::get('email'), 
				'password' => Input::get('password'),
				'active' => 1
			];

			if(Auth::attempt($credentials, Input::has('remember'))) {
            
            	return redirect('/home')->with('message','Ok se ha autentificado correctamente');
            	

        	}else{
        		return redirect('/home')->with('message_warning','Error al autentificarse, datos incorrectos o su cuenta no esta activa');
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
