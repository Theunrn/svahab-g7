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
            $table->integer('user_id');
            $table->enum('order_status', ['confirmed', 'cancelled', 'pending'])->default('pending');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid')->nullable();
            $table->date('order_date')->nullable();
<<<<<<< HEAD
            $table->decimal('total_amount', 8, 2);
=======
>>>>>>> 4346b9ed70f9be6db2e1dacccddbbdd1b010acbb
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
