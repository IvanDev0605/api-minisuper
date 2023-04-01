<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idMake');
            $table->unsignedBigInteger('idType');
            $table->unsignedBigInteger('idSize');
            $table->bigInteger('codeProduct')->unique();
            $table->string('nameProduct')->unique();
            $table->string('imgProduct');
            $table->integer('stock');
            $table->decimal('purchasePrice', 10, 2);
            $table->decimal('salePrice', 10, 2);
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idMake')->references('id')->on('makesProduct');
            $table->foreign('idType')->references('id')->on('typesProducts');
            $table->foreign('idSize')->references('id')->on('sizes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
