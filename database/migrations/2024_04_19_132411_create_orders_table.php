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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('order_ref_id')->unique()->nullable();
            $table->string('status');
            $table->float('tax_percentage');
            $table->float('discount_percentage');
            $table->float('final_amount');
            $table->text('billing_address');
            $table->text('shipping_address');
            $table->timestamp('placed_on');
            $table->timestamp('packed_on');
            $table->timestamp('shipped_on');
            $table->timestamp('delivered_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchased_books', function (Blueprint $table){
            $table->dropForeignIdFor(\App\Models\Order::class);
        });
        Schema::dropIfExists('orders');
    }
};
