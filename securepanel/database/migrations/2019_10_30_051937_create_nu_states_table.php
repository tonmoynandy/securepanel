<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('states', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('country_id');
			$table->string('name');
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
		Schema::drop('nu_states');
	}

}
