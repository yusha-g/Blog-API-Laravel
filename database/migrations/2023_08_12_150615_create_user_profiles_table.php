<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('profile_id');
            $table->unsignedBigInteger('user_id')->notNullable();
            $table->string('first_name')->notNullable();
            $table->string('last_name')->nullable();
            $table->enum('role', ['editor', 'writer'])->default('writer');
            $table->timestamps();
        });

        //RELATIONS

        Schema::table('user_profiles', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
