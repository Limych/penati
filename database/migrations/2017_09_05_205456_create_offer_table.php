<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->integer('agent_id')->unsigned();
			$table->string('title');
			$table->string('badgeFPath')->nullable()->default(null);
			$table->string('price');
			$table->string('address');
			$table->double('latitude')->index();
			$table->double('longitude')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}