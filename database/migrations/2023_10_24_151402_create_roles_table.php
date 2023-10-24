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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Clau primària autoincremental
            $table->string('name')->unique(); // Columna amb restricció d'unicitat
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(); // Afegir la columna role_id a la taula users amb opcio de valors null
            $table->foreign('role_id')->references('id')->on('roles'); // Afegir la clau forana
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Eliminar la clau forana
            $table->dropColumn('role_id'); // Eliminar la columna role_id
        });
        Schema::dropIfExists('roles'); // Eliminar la taula roles
        
        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true
         ]);
         
    }
};
