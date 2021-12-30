<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadedContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id');
            $table->enum('phone_column_confirmed',['yes','no'])->default('no');
            $table->string('name_column')->nullable();
            $table->enum('head_row_confirm', ['yes','no'])->default('no');
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
        Schema::dropIfExists('uploaded_contacts');
    }
}
