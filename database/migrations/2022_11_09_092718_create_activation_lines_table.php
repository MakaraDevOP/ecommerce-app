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
        Schema::create('activation_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('activation_id');
            $table->integer('product_id');
            $table->integer('term_id');
            $table->integer('period');
            $table->integer('user_no');
            $table->string('note')->nullable();
            $table->string('activated_date');
            $table->string('expired_date');
            $table->integer('status');
            $table->integer('order_by');
            $table->integer('is_active');
            $table->integer('is_notify_email');
            $table->integer('is_free');
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
        Schema::dropIfExists('activation_lines');
    }
};