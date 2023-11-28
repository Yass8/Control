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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->integer('num')->unique();
            $table->text('description');
            $table->double('credit', 10, 2)->default(0);
            $table->double('debit', 10, 2)->default(0);
            $table->double('nv_solde', 10, 2);
            $table->unsignedInteger('version_id');
            $table->foreign('version_id')->references('id')->on('versions')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
