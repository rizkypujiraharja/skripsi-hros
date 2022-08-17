<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('nip', 100);
            $table->string('ktp');
            $table->string('npwp');
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->date('birth_date');
            $table->bigInteger('sallary');
            $table->string('position');
            $table->date('joined_at')->nullable();
            $table->string('contract_until')->nullable();
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
