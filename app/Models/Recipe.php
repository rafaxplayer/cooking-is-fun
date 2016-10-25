<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recipe extends Model {

	protected $table = 'recipes';

	
	protected $fillable = ['id','name', 'ingredients', 'elaboration','elaboration_time','user_id','img_url'];
	
	public function user(){

		return $this->belongsTo('App\Models\User');
	}

	public function categories(){

		return $this->belongsToMany('App\Models\Category');
	}

}
