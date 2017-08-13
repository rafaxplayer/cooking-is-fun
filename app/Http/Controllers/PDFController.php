<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class PDFController extends Controller {

	public function RecipeToPdf($id) 
    {
    	$recipe = Recipe::findOrFail($id);
       
        $view = \View::make('pdf.recipe', compact('recipe'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream($recipe->name);
    }
    

}
