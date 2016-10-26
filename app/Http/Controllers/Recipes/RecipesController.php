<?php namespace App\Http\Controllers\Recipes;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Validator;
use App\Models\Recipe;
use Illuminate\Http\Request;

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
	public function index()
	{
		
		return view('recipes.listrecipes');
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('recipes.newrecipe');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$postData = Input::all();
		

	    $rules = [

	     'name' => 'required|max:50|min:6',
	     'imageUpload' =>'image|max:15500',
	     'ingredients' =>'required|min:10',
	     'elaboration' =>'required|min:10',
	     
	     
	    ];

	    $messages = [

	     'name.required'=>'Enter required name',
	     'name.max'=>'Max name 50 chars',
	     'name.min'=>'Min name 6 chars',
         'imageUpload.image' => 'Image file is required',
         'imageUpload.max' => 'Max size for image 15500kb',
         'ingredients.required' => 'Require ingredients for recipe',
         'ingredients.min' => 'Min size 10 chars',
         'elaboration.required' => 'Require ingredients for recipe',
         'elaboration.min' => 'Min size 10 chars',
         
     	];

     	$validator = Validator::make($postData, $rules,$messages);

		if ($validator->fails()) {
		      
		    return redirect('/recipes/create')->withInput()->withErrors($validator);
		}
    	else {
			$recipe = new Recipe();
			$recipe->img_url = url('/')."/public/img/recipe_placeholder.png";
			if(Input::hasFile('imageUpload')){
				$name = str_random(10)."-".Input::file('imageUpload')->getClientOriginalName();
				$newpath = str_replace("\\","/",public_path('/uploads/recipeimages/'));
				Input::file('imageUpload')->move($newpath,$name);
				$urlimage=url('public/uploads/recipeimages/'.$name);
				$recipe->img_url = $urlimage;

			}
			
			if(!empty(Input::get('img_url'))){

				$recipe->img_url = Input::get('img_url');
			}

			$recipe->name=Input::get('name');
			$recipe->ingredients=Input::get('ingredients');
			$recipe->elaboration=Input::get('elaboration');
			$recipe->elaboration_time = Input::get('elaboration_time');
			$recipe->user_id = Auth::user()->id;
			$categories_checked= Input::get('categories');
			$result = $recipe->save();
 			
			if($result){

				if(is_array($categories_checked))
 				{
    				$recipe->categories()->sync($categories_checked);
 				}
 				
				return redirect("/recipes")->with('message','Ok receta guardada con exito');
			}else{
				return redirect("/recipes/create")->with('message_warning','Ocurrio un error al guardar la receta');
			}
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// $recipe=App\Models\Recipe::find($id);
		// return view('recipes.detailrecipe',['recipe'=>$recipe]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// $recipe=App\Models\Recipe::find($id);
		// return view('recipes.editrecipe',['recipe'=>$recipe]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

}
