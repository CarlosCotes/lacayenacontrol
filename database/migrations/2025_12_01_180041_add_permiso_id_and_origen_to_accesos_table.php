<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('accesos', function (Blueprint $table) {

            // Campo para relacionar con permisos temporales
            $table->unsignedBigInteger('permiso_id')->nullable()->after('user_id');

            // Tipo de origen: "user" o "permiso"
            $table->enum('origen', ['user', 'permiso'])->default('user')->after('id');

            // FK opcional
            $table->foreign('permiso_id')->references('id')->on('permisos_temporales')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('accesos', function (Blueprint $table) {

            $table->dropForeign(['permiso_id']);
            $table->dropColumn('permiso_id');
            $table->dropColumn('origen');
        });
    }
};
