<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('description');
            $table->string('fit_type')->nullable()->after('brand');
            $table->string('gender')->nullable()->after('fit_type');
            $table->integer('availability')->default(0)->after('gender');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'fit_type', 'gender', 'availability']);
        });
    }
}
