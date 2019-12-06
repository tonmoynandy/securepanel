<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuTranslateCmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translate_cms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('page_id')->index('page_id');
			$table->char('lang_code', 4);
			$table->integer('banner_id')->nullable();
			$table->string('title');
			$table->text('description');
			$table->string('meta_title');
			$table->text('meta_description', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nu_translate_cms');
	}

}
