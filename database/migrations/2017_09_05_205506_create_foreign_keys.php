<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('offer_assets', function(Blueprint $table) {
			$table->foreign('offer_id')->references('id')->on('offers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_agent_id_foreign');
		});
		Schema::table('offer_assets', function(Blueprint $table) {
			$table->dropForeign('offer_assets_offer_id_foreign');
		});
	}
}