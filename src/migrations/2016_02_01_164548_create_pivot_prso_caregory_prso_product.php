<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotPrsoCaregoryPrsoProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prso_category_prso_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prso_category_id');
            $table->unsignedInteger('prso_product_id');
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
        Schema::drop('prso_category_prso_product');
    }
}
