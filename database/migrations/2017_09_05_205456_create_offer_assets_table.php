<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferAssetsTable extends Migration {

	public function up()
	{
		Schema::create('offer_assets', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('offer_id')->unsigned();
            $table->string('slug');
			$table->integer('sortKey')->unsigned();
			$table->string('title');
			$table->string('description');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();

			$table->unique([ 'offer_id', 'slug' ]);
		});
	}

	public function down()
	{
		Schema::drop('offer_assets');
	}
}