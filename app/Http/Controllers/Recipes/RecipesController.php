<?php namespace App\Http\Controllers\Recipes;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Log;
use Validator;
use App\Models\Recipe;
class RecipesController extends Controller {


	public function __construct()
	{
		$this->middleware('auth',['except'=>['index','show']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$recipes = Recipe::paginate(9);
		$recipes->setPath('recipes');
		return view('recipes.listrecipes',compact('recipes'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){

		return view('recipes.newrecipe');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){

		$recipe = new Recipe();
		$result= $this->editOrCreateRecipe($recipe);
		
		if($result === true){
				
			return redirect("/recipes")->with('message',trans('messages.recipes.save'));

		}else if($result === false){

			return redirect("/recipes/create")->with('message_warning',trans('messages.recipes.errorsave'));
		}else{
			return $result;
		}

	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		
		$recipe = Recipe::findOrFail($id);
			
		$favorite = $recipe->usersfavorite->contains(Auth::user());
		
		return view('recipes.detailrecipe',['recipe'=>$recipe,'favorite'=>$favorite]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){

		$recipe = Recipe::findOrFail($id);
		$cats = $recipe->categories()->get();
		return view('recipes.editrecipe',['recipe'=>$recipe,'cats'=>$cats]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){

		$recipe = Recipe::findOrFail($id);
		$result = $this->editOrCreateRecipe($recipe);

		if($result===true){
				
			return redirect("/recipes/".$id)->with('message',trans('messages.recipes.update'));

		}else if($result===false){

			return redirect("/recipes/".$id."/edit")->with('message_warning',trans('messages.recipes.errorsave'));
		}else{
			return $result;
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$recipe = Recipe::findOrFail($id);
		$recipe->delete();
		return redirect("/recipes")->with('message',trans('messages.recipes.delete'));
	}

	/**
	* Aditional functions for Recipes
	*
	*/

	//Favorites manager
	public function addFavorites($recipeid){

		$user=Auth::user();
		$user->favorites()->attach($recipeid);
		return redirect('recipes/'.$recipeid)->with('message',trans('messages.recipes.favorites'));
	}

	public function removeFavorites($recipeid){

		$user = Auth::user();
		$user->favorites()->detach($recipeid);
		return redirect('recipes/'.$recipeid)->with('message',trans('messages.recipes.favoritesdelete'));
	}
	//End Favorites

	//Search Recipes Functions
	public function searchWithCat(){

		$id = Input::get('id');

		$recipes = Recipe::whereHas('categories',function($q) use ($id){

		  	$q->where('category_id','=',$id);

		  })->paginate(9);

		$recipes->setPath('recipes');
		
		return view('recipes.listrecipes_min',compact('recipes'));
	}

	public function search(){

		$recipes = Recipe::paginate(9);
		$recipes->setPath('recipes');
		
		if(Input::has('pattern')){
			
			if(strlen(Input::get('pattern')) > 0){

				$recipes = Recipe::where('name','like', '%' . Input::get('pattern') . '%')->paginate(9);
				$recipes->setPath('recipes');
				if(count($recipes) > 0){

					return view('recipes.listrecipes_min',compact('recipes'));

				}
			}
			
		}
		return view('recipes.listrecipes_min',compact('recipes'));
			
	}

	public function searchFavorites(){

		$recipes = Auth::user()->favorites()->paginate(9);

		$recipes->setPath('recipes');
		
		return view('recipes.listrecipes',compact('recipes'));
	}

	// cms for recipe edit or create
	protected function editOrCreateRecipe(Recipe $recipe){

		$postData = Input::all();
		
	    $rules = [

		     'namerecipe' => 'required|max:50|min:6',
		     'imageUpload' =>'image|max:15500',
		     'ingredients' =>'required|min:10',
		     'elaboration' =>'required|min:10',
		     'img_url' =>'url|max:255',
	     
	    ];

     	$validator = Validator::make($postData,$rules);

		if($validator->fails()) {
		      
		    return redirect('/recipes/create')->withInput()->withErrors($validator);
		    exit();
		}
    	else {

			
			if(Input::hasFile('imageUpload')){

				$name = str_random(10)."-".Input::file('imageUpload')->getClientOriginalName();
				$newpath = str_replace("\\","/",public_path('uploads/recipeimages/'));
				
				Input::file('imageUpload')->move($newpath,$name);

				//delete old image if exists
				$recipe->deleteImage();

				$urlimage = url('public/uploads/recipeimages/'.$name);
				$recipe->img_url = $urlimage;

			}
			
			if(!empty(Input::get('img_url'))){

				if(strpos($recipe->img_url,Input::get('img_url'))===false){
					
					$recipe->deleteImage();
				}

				$recipe->img_url = Input::get('img_url');

			}

			$recipe->name = Input::get('namerecipe');
			$recipe->ingredients = Input::get('ingredients');
			$recipe->elaboration = Input::get('elaboration');
			$recipe->elaboration_time = Input::get('elaboration_time');
			$recipe->user_id = Auth::user()->id;
			$categories_checked = Input::get('categories');
			$result = $recipe->save();
 			
			if($result){

				if(is_array($categories_checked))
 				{
    				$recipe->categories()->sync($categories_checked);
 				}else{
 					$recipe->categories()->attach(15);
 				}
 				
			}
			return $result;
		}

	}
}
