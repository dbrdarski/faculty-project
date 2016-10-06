<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration{
	public function up(){
		Schema::create('users'), function (Blueprint $table){
			$table->increments('id');
			$table->string('password');
			$table->string('subjectName');
			$table->timestamps();
		}
	}

	public function down(){
		Schema::drop('users');
	}
}