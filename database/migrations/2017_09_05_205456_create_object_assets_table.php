<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObjectAssetsTable extends Migration {

	public function up()
	{
		Schema::create('object_assets', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('object_id')->unsigned();
            $table->string('slug');
			$table->integer('sortKey')->unsigned();
			$table->string('title');
			$table->string('description');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();

			$table->unique([ 'object_id', 'slug' ]);
		});
	}

	public function down()
	{
		Schema::drop('object_assets');
	}
}