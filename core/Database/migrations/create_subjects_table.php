<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration{
	public function up(){
		Schema::create('courses'), function (Blueprint $table){
			$table->increments('id');
			$table->string('password');
			$table->string('course_name');
			$table->timestamps();
		}
	}

	public function down(){
		Schema::drop('courses');
	}
}