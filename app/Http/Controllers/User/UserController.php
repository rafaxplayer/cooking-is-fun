<?php namespace App\Http\Controllers\user;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use Hash;
use Log;
use Mail;
use App\Models\Recipe;
use App\Models\User;
class UserController extends Controller {


	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getPanel($param = null)
	{
		$user = Auth::user();

		$recipes = Auth::user()->recipes()->paginate(10);
		$recipes->setPath('recipes');
		return view('user.user_panel',['user'=> $user ,'view'=>$param,'recipes'=>$recipes]);
		
	}

	public function getContact()
	{
		
		return view('user.user_contact');
		
	}

	public function postContact(){

		$postData = Input::all();
		
		$rules = [
	      'email' => 'required|email',
	      'subject' => 'required|max:40|min:5',
	      'message' => 'required|min:5',
	    ];

	    $messages = [

	     'email.required' => 'Enter required email',
	     'email.email' => 'Invalid email format',
         'subject.required' => 'Email required subject',
         'subject.min' => 'Subject  is short',
         'subject.max' => 'Subject  is long',
         'message.required' => 'Enter required message',
         'message.min' => 'Message is short',

     	];
		
     	$validator = Validator::make($postData, $rules, $messages);
		
		if($validator->fails()){

		    return redirect('/user/contact')->withInput()->withErrors($validator);

		}else{

			$name=Auth::user()->name;
			$email=Input::get('email');
			$mess=Input::get('message');
			$subject=Input::get('subject');
			Mail::send('emails.contact', 
				['name'=> $name,'mess'=>$mess,'email'=> $email],function($message) use($subject){

				$message->from('amsapzs@gmail.com');
    			$message->to('amsapzs@gmail.com', 'Admin')->subject($subject);

			});
			return redirect('/home')->with('message', trans('messages.user.contactok'));
		}
		
	}
	public function postPassword()
	{
		$postData = Input::all();

		$rules = [
	      'oldpassword' => 'required',
	      'password' => 'required',
	      'password_confirmation' => 'required|same:password'
	    ];

	    $messages = [
	     'oldpassword.required'=>'Enter required password',
	     'password.required' => 'Enter required password',
         'password_confirmation.required' => 'Email confirm is required',
         'password_confirmation.same' => 'Email confirm is not equal'
     	];

     	$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {
		      
		    return redirect('user/panel/password')->withInput()->withErrors($validator);

		}else{
			
			if(Hash::check(Input::get('oldpassword'),Auth::user()->password)){

				$user= Auth::user();

				$user->password = bcryp(Input::get('password'));

				if($user->save()){

					return redirect('user/panel/password')->with('message','Tu contraseña a sido actualizada con exito!');
				}else{

					return redirect('user/panel/password')->with('message_warning','Ocurrio un error al actualizar tu password');
				}


			}else{
				return redirect('user/panel/password')->with('message_warning','La contraseña no es valida');
			}

		}
		
	}
	public function postAvatar(){

		$postData = Input::all();

	    $rules = [
	     'avatarUpload' =>'image|max:1000',
	     'avatarUrl' => 'url'
	    ];

	    $messages = [
         'avatarUpload.image' => 'Image file is required',
         'avatarUpload.max' => 'Max size for image 1000kb',
         'avatarUrl.url' => 'Incorrect format for url'
     	];

     	$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {
		      
		    return redirect('/user/panel/avatar')->withInput()->withErrors($validator);

		}else{

			$user = Auth::user();

			if(Input::hasFile('avatarUpload')){

				$name = str_random(10)."-".Input::file('avatarUpload')->getClientOriginalName();

				$newpath = str_replace("\\","/",public_path('uploads/avatars/'));
				
				Input::file('avatarUpload')->move($newpath, $name);

				$user->deleteAvatar();

				$urlavatar = url('public/uploads/avatars/'.$name);

				$user->avatar = $urlavatar;

			}
			
			if(!empty(Input::get('avatarUrl'))){

				$user->avatar = Input::get('avatarUrl');
			}

			$result = $user->save();

			if($result){
				return redirect('user/panel/avatar')->with('message','Ok avatar atualizado');
			}else{
				return redirect('user/panel/avatar')->with('message_warning','Ocurrio un error al actualizar su perfil');
			}
		}
	}
	public function postEmail(){

		$postData = Input::all();
		$user = Auth::user();

	    $rules = [

	     'email' =>'required|email|unique:users'
	    ];

	    $messages = [
         'email.required' => 'Email is required.',
         'email.email' => 'Invalid format email.',
         'email.unique' => 'This email already exists.'
     	];

     	$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {
		      
		    return redirect('/user/panel/email')->withInput()->withErrors($validator);

		}else{
			$user->email=strtolower(Input::get('email'));
			if($user->save()){
				return redirect('/user/panel/email')->with('message','Ok email updated');
			}

		}
	}
}
