<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Input;
use Validator;
use Auth;
class adminController extends Controller {


	public function __construct()
	{
		$this->middleware('admin');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getPanel($param = null)
	{
		switch($param){
			case'users':
				$users = User::paginate(20);
				$users->setPath('users');
				return view('admin.panel',['view'=>$param,'users'=>$users]);
				break;
			case 'recipes':
				$recipes = Recipe::paginate(15);
				$recipes->setPath('recipes');
				return view('admin.panel',['view'=>$param,'recipes'=>$recipes]);
				break;
			default:
				$users = User::paginate(20);
				$users->setPath('users');
				return view('admin.panel',['view'=>$param,'users'=>$users]);
		}
		
	}

	public function getUserEdit($id)
	{
		
		$user = User::findOrFail($id);
		return view('admin.user_edit',['user'=>$user]);
	}

	public function searchUser(){

		if(Input::has('pattern')){

			if(strlen(Input::get('pattern')) > 0){

				$users = User::where('name','LIKE','%'.Input::get('pattern').'%')
					->paginate(20);
				$users->setPath('users');
				if(count($users) > 0){

					return view('admin.panel',['view'=>'users','users'=>$users]);
				}
			}
		}
		return redirect('admin/users')->with('message','No se encontraron usuarios');
	}

	public function searchRecipesWithPattern(){

		if(Input::has('pattern')){

			if(strlen(Input::get('pattern')) > 0){

				$recipes = Recipe::where('name','LIKE','%'.Input::get('pattern').'%')
					->paginate(20);
				$recipes->setPath('recipes');
				if(count($recipes) > 0){

					return view('admin.panel',['view'=>'recipes','recipes'=>$recipes]);
				}
			}
		}
		
		return redirect('admin/recipes')->with('message','No se encontraron recetas');
	}

	public function searchRecipesWithUsername(){

		if(Input::has('username')){

			if(strlen(Input::get('username')) > 0){
				
				$recipes = Recipe::whereHas('user', function ($q) 
				{
    				$q->where('name', 'like', '%'.Input::get('username').'%');  
				})->paginate(4); 
				$recipes->setPath('recipes');
				if(count($recipes) > 0){

					return view('admin.panel',['view'=>'recipes','recipes'=>$recipes]);
				}
			}
		}
		return redirect('admin/recipes')->with('message','No se encontraron recetas');
	}
	public function deleteUser($id){

		if(Auth::user()->id == $id){
			return redirect()->back()->with('message_warning','No te puedes eliminar tu mismo');
		}
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->back()->with('message','Usuario eliminado');
	}

	public function postUserEdit()
	{
		$userData = Input::all();
		
		$rules = [
	      'name' => 'required|max:22|min:6',
	      'email' => 'required|email',
	      'password' => 'min:8',
	      'avatarUpload' =>'image|max:1000',
	      'avatarUrl' => 'url'
	      
	    ];

	    $messages = [
	     'name.required'=>'Enter required name',
	     'name.max'=>'Max name 22',
	     'name.min'=>'Min name 6',
         'email.required' => 'Enter email address',
         'email.email' => 'Invalid email format',
         'password.min'=> 'Passowrd min 6 chars',
         'avatarUpload.image' => 'Image file is required',
         'avatarUpload.max' => 'Max size for image 1000kb',
         'avatarUrl.url' => 'Incorrect format for url'
         
         
     	];

     	$validator = Validator::make($userData, $rules,$messages);

		if ($validator->fails()) {
		      
		    return redirect('/auth/register')->withInput()->withErrors($validator);
		}
    	else {

    		$user = User::findOrFail(Input::get('userid'));

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

			if(!empty(Input::get('password'))){

				$user->password = bcrypt(Input::get('password'));
			}

			$user->name=Input::get('name');
			$user->email=Input::get('email');
			$user->range=Input::get('range');
			$user->active=Input::get('active');
			$result=$user->save();

			if($result){
				return redirect('admin/users')->with('message','Ok usuario atualizado');
			}else{

				return redirect('admin/users')->with('message_warning','Ocurrio un error al actualizar el usuario');
			}

    	}
		
	}
	

}
