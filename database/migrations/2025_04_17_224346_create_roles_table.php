<?php
// database/migrations/xxxx_xx_xx_create_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insert default roles (e.g., Admin, Memorizer)
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'memorizer'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
