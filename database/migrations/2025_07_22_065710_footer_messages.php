<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FooterMessage;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer_messages', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // Section name like 'shop', 'customer_service', etc.
            $table->text('message'); // The customizable message for that section
            $table->timestamps();
        });

        // Pre-fill records for each section in the footer
        $sections = [
            'customer_service_contact_us', 
            'customer_service_faqs', 
            'customer_service_shipping_policy', 
            'customer_service_returns_exchanges',
        ];

        foreach ($sections as $section) {
            FooterMessage::updateOrCreate(['section' => $section], ['message' => '']);
        }
    }

    public function down()
    {
        Schema::dropIfExists('footer_messages');
    }
};
