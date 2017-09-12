<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentsTable extends Migration {

	public function up()
	{
		Schema::create('agents', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->integer('user_id')->unsigned()->index()->nullable()->default(null);
			$table->string('fullName');
			$table->string('displayName');
			$table->string('photoFPath')->nullable()->default(null);
			$table->string('slogan')->nullable()->default(null);
			$table->text('description')->nullable()->default(null);
			$table->text('contactUris');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('agents');
	}
}