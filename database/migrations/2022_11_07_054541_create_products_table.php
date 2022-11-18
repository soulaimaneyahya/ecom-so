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
            $table->uuid('id')->index()->primary();
            $table->string('name', 255);
            $table->text('description');
            $table->float('price_before', 8, 2)->nullable();
            $table->float('price', 8, 2);
            $table->integer('stock')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'stock']);
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
