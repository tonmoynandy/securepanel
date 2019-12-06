<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuTranslateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translate_countries', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('country_id');
			$table->char('lang_code', 4);
			$table->string('name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nu_translate_countries');
	}

}
