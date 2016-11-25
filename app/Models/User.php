<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Recipe;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	
	protected $table = 'users';

	
	protected $fillable = ['name', 'email', 'password','avatar','range'];

	
	protected $hidden = ['password', 'remember_token'];
	
	public static function boot()
    {
        static::creating(function ($model) {
            // blah blah
        });

        static::updating(function ($model) {
            
        });

        static::deleting(function ($model) {
        	//delete recipes for user
            Recipe::where('user_id', '=',$model->id)->delete();
            //delete avatar
            $model->deleteAvatar();

        });
        
        parent::boot();
    }

    public function deleteAvatar(){

    	$basepath = str_replace("\\","/",public_path('uploads/avatar'));
        $baseurl = url('/public/uploads/avatar/');
        $path = str_replace($baseurl,$basepath,$this->avatar);
		
        if(File::exists($path)){
        	
            File::delete($path);
        }

    }

	public function isAdmin(){
		
		return $this->range == 'admin';
	}

	public function recipes(){

		return $this->hasMany('App\Models\Recipe');
	}

	public function favorites(){
        
        return $this->belongsToMany('App\Models\Recipe','favorites','user_id','recipe_id')->withTimestamps();
    }
	

}
