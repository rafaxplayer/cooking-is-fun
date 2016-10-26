<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {


	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',20)->unique();
			$table->timestamps();
		});

		$categories = array('Entrantes','Ensaladas','Aperitivos','Arroces','Primeros','Huevos','Carnes','Pescados','Segundos','Vegetales','Postres','Salsas');

		foreach ($categories as $cat){

			DB::table('categories')->insert(['name'=>$cat]);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
