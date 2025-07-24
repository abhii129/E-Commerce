<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FooterMessage; // <-- Add this line to import the model


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Creating records for each option
    $sections = [
        'shop_all_products', 'shop_featured', 'shop_new_arrivals', 'shop_sale_items',
        'customer_service_contact_us', 'customer_service_faqs', 'customer_service_shipping_policy', 'customer_service_returns_exchanges',
        'about_us_our_story', 'about_us_blog', 'about_us_careers', 'about_us_privacy_policy',
        'connect_with_us_facebook', 'connect_with_us_instagram', 'connect_with_us_twitter', 'connect_with_us_pinterest',
    ];

    foreach ($sections as $section) {
        FooterMessage::updateOrCreate(['section' => $section], ['message' => '']);
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footer_messages', function (Blueprint $table) {
            //
        });
    }
};
