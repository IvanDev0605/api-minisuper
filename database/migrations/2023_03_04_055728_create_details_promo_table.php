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
        Schema::create('details_promo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProduct');
            $table->unsignedBigInteger('idPromo');
            $table->integer('quantityPieces');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->foreign('idPromo')->references('id')->on('promotions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_promo');
    }
};
