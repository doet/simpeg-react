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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $data = [
          ['id'=>1, 'name'=>'admin','email' => 'admin@admin.com', 'password' => '$2y$10$f23nfsOKUnKkeeI6hr4CuuUSGSrmRgx6jxPJDmcVpvXiGxZn8riDm'],
          ['id'=>2, 'name'=>'manager','email' => 'manager@admin.com', 'password' => '$2y$10$f23nfsOKUnKkeeI6hr4CuuUSGSrmRgx6jxPJDmcVpvXiGxZn8riDm'],
          ['id'=>3, 'name'=>'operator','email' => 'operator@admin.com', 'password' => '$2y$10$f23nfsOKUnKkeeI6hr4CuuUSGSrmRgx6jxPJDmcVpvXiGxZn8riDm'],
          ['id'=>4, 'name'=>'user1','email' => 'user1@admin.com', 'password' => '$2y$10$f23nfsOKUnKkeeI6hr4CuuUSGSrmRgx6jxPJDmcVpvXiGxZn8riDm'],
          ['id'=>5, 'name'=>'user2','email' => 'user2@admin.com', 'password' => '$2y$10$f23nfsOKUnKkeeI6hr4CuuUSGSrmRgx6jxPJDmcVpvXiGxZn8riDm']
        ];

        DB::table('users')->insert($data);
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
