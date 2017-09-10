<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('agents', function(Blueprint $table) {
			$table->foreign('office_id')->references('id')->on('offices')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agents', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
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
		Schema::table('agents', function(Blueprint $table) {
			$table->dropForeign('agents_office_id_foreign');
		});
		Schema::table('agents', function(Blueprint $table) {
			$table->dropForeign('agents_user_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_agent_id_foreign');
		});
		Schema::table('offer_assets', function(Blueprint $table) {
			$table->dropForeign('offer_assets_offer_id_foreign');
		});
	}
}