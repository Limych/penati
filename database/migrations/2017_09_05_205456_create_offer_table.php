<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTable extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foreign_id')->unique();
            $table->string('slug', 80)->unique();
            $table->integer('agent_id')->unsigned();
            $table->string('title');
            $table->string('badgeFPath')->nullable()->default(null);
            $table->string('price');
            $table->string('address');
            $table->double('latitude')->index();
            $table->double('longitude')->index();
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::drop('offers');
    }
}
