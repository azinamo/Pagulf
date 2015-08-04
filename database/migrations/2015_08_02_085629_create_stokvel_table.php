<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokvelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create Stokvel table
        Schema::create('stokvel', function(Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->decimal('amount');
           $table->date('start_date');
           $table->date('end_date');
           $table->boolean('has_payment_order')->nullable();
           $table->boolean('is_active')->nullable();
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
		//
        Schema::drop('stokvel');
	}

}
