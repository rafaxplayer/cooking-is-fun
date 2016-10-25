<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model {

	protected $table = 'categories';

	protected $fillable = ['id','name'];

	public function recipes(){
		
		return $this->belongsToMany('App\Models\Recipes');
	}
}
