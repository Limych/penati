<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfficesTable extends Migration {

	public function up()
	{
		Schema::create('offices', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->string('title')->unique();
			$table->string('logotypeFPath')->nullable()->default(null);
			$table->string('slogan')->nullable()->default(null);
			$table->text('description')->nullable()->default(null);
			$table->text('contactUris');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('offices');
	}
}