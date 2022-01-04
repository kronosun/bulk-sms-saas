<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('reference');
            $table->decimal('amount', '10','2');
            $table->string('status');
            $table->string('description');
            $table->string('transaction_id')->nullable();
            $table->string('currency')->default('NGN');
            $table->decimal('usd_value', '10', '2');
            $table->integer('paid_on');
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
        Schema::dropIfExists('payments');
    }
}
