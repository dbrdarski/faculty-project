<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration{
	public function up(){
		Schema::create('users'), function (Blueprint $table){
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('firstName');
			$table->string('lastName');
			$table->string('gender');
			$table->string('type');
			$table->timestamps();
		}
	}

	public function down(){
		Schema::drop('users');
	}
}