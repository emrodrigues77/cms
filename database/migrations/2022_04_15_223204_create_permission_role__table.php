<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->unique(['permission_id', 'role_id']);
            $table->foreignId('permission_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permission_role');
    }
};