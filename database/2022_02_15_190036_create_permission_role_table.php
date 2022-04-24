<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->id();
        $table->foreignId('permission_is')->constrained('permissions')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreignId('role_id')->constrained('roles')->cascadeOnUpdate()->cascadeOnDelete();
        $table->primary(['role_id','permission_is']);
        $table->timestamp('created_at')->useCurrent();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
