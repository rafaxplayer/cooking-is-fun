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

            $basepath = str_replace("\\","/",public_path('uploads/recipeimages'));
            $baseurl = url('/public/uploads/recipeimages/');
            $path = str_replace($baseurl,$basepath,$model->img_url);

            if(File::exists($path)){

                File::delete($path);
            }
            
        });
        
        parent::boot();
    }
	
	public function user(){

		return $this->belongsTo('App\Models\User');
	}

	public function categories(){

		return $this->belongsToMany('App\Models\Category','category_recipe','recipe_id','category_id')->withTimestamps();
	}

    public function usersfavorite(){

        return $this->belongsToMany('App\Models\User','favorites','recipe_id','user_id')->withTimestamps();
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
