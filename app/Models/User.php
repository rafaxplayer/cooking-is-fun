<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
            // bleh bleh
        });

        static::deleting(function ($model) {
        	//delete recipes for user
            Recipe::where('user_id', '=',$model->id)->delete();
        });
        
        parent::boot();
    }

	public function isAdmin(){
		
		return $this->range == 'admin';
	}

	public function recipes(){

		return $this->hasMany('App\Models\Recipe');
	}
	

}
