<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id');
             $table->string('registration_number');
            $table->string('name');
            $table->string('court');
            $table->string('organizational_form');
            $table->string('settlement_number');
            $table->string('settlement_date');
            $table->string('jib');
            $table->string('pib');
            $table->string('place');
            $table->string('street_address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('fax')->nullable();
            $table->string('email',100)->nullable();
            $table->string('activities_key');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('legal_entities');
    }
}
