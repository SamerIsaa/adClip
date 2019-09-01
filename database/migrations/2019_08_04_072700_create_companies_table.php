<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('description_ar');
            $table->string('description_en');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('catagory_id')->nullable();

            $table->dateTime('subscription');
            $table->dateTime('end_subscription');

            $table->boolean('endSubscription')->default(0);

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('catagory_id')->references('id')->on('catagories');

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
        Schema::dropIfExists('companies');
    }
}
