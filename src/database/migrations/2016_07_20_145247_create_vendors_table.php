<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('legal_name');
            $table->json('previous_legal_names')->nullable()->default(null);
            $table->json('alternative_names')->nullable()->default(null);
            $table->integer('establishment_type_id')->unsigned()->nullable()->default(null);
            $table->string('duns')->nullable()->default(null);
            $table->string('ein')->nullable()->default(null);
            $table->string('tin')->nullable()->default(null);
            $table->integer('customers_region')->unsigned()->nullable()->default(null);
            $table->integer('customers_domestic')->unsigned()->nullable()->default(null);
            $table->integer('customers_foreign')->unsigned()->nullable()->default(null);
            $table->integer('fulltime_employees')->unsigned()->nullable()->default(null);
            $table->dateTime('established_at')->nullable()->default(null);
            $table->integer('created_by')->unsigned()->default(0);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->integer('deleted_by')->unsigned()->nullable()->default(null);
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
        Schema::drop('vendors');
    }
}
