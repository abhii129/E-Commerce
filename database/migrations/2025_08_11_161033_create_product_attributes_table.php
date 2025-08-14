<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('name'); // Attribute name (e.g., "Size", "Color")
            $table->string('type'); // Type of input (e.g., "text", "select", etc.)
            $table->json('options')->nullable(); // Options for select type (e.g., ["S", "M", "L"])
            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');

            // Indexes for faster querying
            $table->index('category_id');
            $table->index('subcategory_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
