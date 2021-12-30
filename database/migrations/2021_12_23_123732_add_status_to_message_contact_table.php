<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMessageContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_message', function (Blueprint $table) {
            $table->enum('status', ['0','1','2','3'])->default('0');
            $table->string('gateway_ref')->nullable();
            $table->text('sent')->nullable();
            $table->text('failed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_message', function (Blueprint $table) {
            //
        });
    }
}
