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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('grade_id')->unsigned()->nullable();
            $table->boolean('invitation')->default(0);
            $table->boolean('admin')->default(0);
            $table->string('company', 200)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('psc', 6)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('web', 50)->nullable();
            $table->string('ico', 12)->unique()->nullable();
            $table->string('dic', 20)->nullable();
            $table->string('email',100)->unique();
            $table->boolean('confirmed')->default(0);
            $table->boolean('locked')->default(0);
            $table->string('slug', 50);
            $table->string('bankName', 50)->nullable();
            $table->string('bankNoAccount', 50)->nullable();
            $table->string('bankNoAccountIban', 50)->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();


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
