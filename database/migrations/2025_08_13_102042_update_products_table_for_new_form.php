<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Ensure required columns exist
            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand')->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'availability')) {
                $table->integer('availability')->default(0)->after('brand');
            }
            if (!Schema::hasColumn('products', 'attributes')) {
                $table->json('attributes')->nullable()->after('availability');
            }

            // Ensure price is nullable decimal
            $table->decimal('price', 10, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'availability', 'attributes']);
            $table->decimal('price', 10, 2)->nullable(false)->change();
        });
    }
};
