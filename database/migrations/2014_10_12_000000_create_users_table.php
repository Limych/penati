<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 80)->unique();
            $table->string('name');
            $table->string('email', 80)->unique();
            $table->string('password');
            $table->string('displayName');
            $table->string('photoFPath')->nullable()->default(null);
            $table->string('slogan')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('contactUris')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
