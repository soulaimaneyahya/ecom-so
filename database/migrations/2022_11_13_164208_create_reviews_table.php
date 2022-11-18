<?php

use App\Models\Review;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->index()->primary();
            $table->foreignUuid('product_id')->index()->constrained();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 255)->unique();
            $table->unsignedTinyInteger('rating');
            $table->string('description', 600);
            $table->string('status')->default(Review::REJECTED_REVIEW);
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
        Schema::dropIfExists('reviews');
    }
};
