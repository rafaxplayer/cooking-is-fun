<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model {

	protected $table = 'categories';

	protected $fillable = ['id','name'];

	public static function boot()
    {
        static::creating(function ($model) {
            // blah blah
        });

        static::updating(function ($model) {
            // bleh bleh
        });

        static::deleting(function ($model) {
            // bluh bluh
        });
        
        parent::boot();
    }

	public function recipes(){
		
		return $this->belongsToMany('App\Models\Recipes');
	}
}
