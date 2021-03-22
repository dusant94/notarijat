<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaturalPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('natural_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id');
            $table->integer('ordinal_number')->nullable();
            $table->string('jmbg',13);
            $table->string('first_name');
             $table->string('fathers_name');
            $table->string('last_name');
            $table->string('place');
            $table->string('street_address')->nullable();
            $table->string('date_of_birth');
            $table->string('place_of_birth')->nullable();
            $table->string('profession')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('fax')->nullable();
            $table->string('email',100)->nullable();
            $table->boolean('gender')->nullable();
            $table->string('role');
            $table->string('marital_status');
            $table->string('identity_established');
            $table->string('identity_card_number');
            $table->string('identity_card_issued');
            $table->string('identity_card_expiration')->nullable();
            $table->boolean('identity_card_permanently')->nullable();
            $table->string('identity_card_issue_place');
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
        Schema::dropIfExists('natural_people');
    }
}
