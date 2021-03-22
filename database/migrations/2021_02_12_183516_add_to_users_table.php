<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('office_id')->nullable();
            $table->string('jmbg',13)->nullable();
            $table->string('fax')->nullable();
             $table->string('mobile_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('profile_photo')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('office_id','jmbg','fax','mobile_no','phone_no','profile_photo');
        });
    }
}
