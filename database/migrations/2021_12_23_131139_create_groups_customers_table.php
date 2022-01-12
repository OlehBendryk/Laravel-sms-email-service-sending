<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('group_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups_customers');
    }
}
