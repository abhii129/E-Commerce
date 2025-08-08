<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('product_variations', function (Blueprint $table) {
        $table->decimal('price_adjustment', 10, 2)->default(0);
    });
}

public function down()
{
    Schema::table('product_variations', function (Blueprint $table) {
        $table->dropColumn('price_adjustment');
    });
}

};
