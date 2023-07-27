<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;





return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
       {
            $role = Role::create(['name' => 'admin']);
            $permission = Permission::create(['name' => 'edit articles']);
            $role->givePermissionTo($permission);



       }

       /**
        * Reverse the migrations.
        *
        * @return void
        */
       public function down()
       {

       }
};
