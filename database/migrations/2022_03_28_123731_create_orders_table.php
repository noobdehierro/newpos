<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('sales_type');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('offering_id')->nullable();
            $table->string('offering_name')->nullable();
            $table->string('offering_description')->nullable();
            $table->decimal('total')->default(0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('imei')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->date('birday')->nullable();
            $table->string('iccid')->nullable();
            $table->string('street')->nullable();
            $table->string('outdoor')->nullable();
            $table->string('indoor')->nullable();
            $table->string('references')->nullable();
            $table->string('postcode')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('response')->nullable();
            $table->unsignedBigInteger('portability_id')->nullable();
            $table->string('channel')->default('pos');
            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table
                ->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->nullOnDelete();

            $table
                ->foreign('portability_id')
                ->references('id')
                ->on('portabilities')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
