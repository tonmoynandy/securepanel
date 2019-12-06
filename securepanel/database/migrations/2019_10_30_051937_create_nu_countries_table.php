<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name');
			$table->string('ccode', 50)->nullable();
			$table->string('phone_code', 10)->nullable();
			$table->string('currency_code', 50)->nullable();
			$table->string('enable_phcode')->default('0');
			$table->integer('flag_image_id')->nullable()->comment('media table id (type 7)');
			$table->timestamps();
			$table->boolean('status')->default(1)->comment('0=inactive, 1=active');
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
		Schema::drop('nu_countries');
	}

}
