<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuAdminUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('email');
			$table->string('password');
			$table->string('name');
			$table->integer('last_login')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nu_admin_users');
	}

}
