<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type')->comment('1=cms,2=books,3=articles,4=author,5=topic,6=service,7=country,8=event,9=ads');
			$table->string('media_type')->comment('1=photo, 2= video');
			$table->integer('element_id');
			$table->string('media_value');
			$table->string('status')->default('1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nu_media');
	}

}
