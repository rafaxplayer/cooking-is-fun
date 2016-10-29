<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;
class recipe extends Model {

	protected $table = 'recipes';

	
	protected $fillable = ['id','name', 'ingredients', 'elaboration','elaboration_time','user_id','img_url'];

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
	
	public function user(){

		return $this->belongsTo('App\Models\User');
	}

	public function categories(){

		return $this->belongsToMany('App\Models\Category');
	}

    public function categoriesToString(){

        $str = "";

        if(count($this->categories) > 0){
            $catnames=[];

            foreach($this->categories as $cat){

                $catnames[]=$cat->name;
            }
            return implode(",",$catnames);

        }
        return $str;

    }
}
