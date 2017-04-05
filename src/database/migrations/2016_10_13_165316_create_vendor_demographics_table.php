<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorDemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_demographics', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('vendor_id');
			$table->integer('customers_region')->nullable()->default(null);
			$table->integer('customers_domestic')->nullable()->default(null);
			$table->integer('customers_foreign')->nullable()->default(null);
			$table->integer('fulltime_employees')->nullable()->default(null);
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_demographics');
    }
}
