<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNuUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user_type')->comment('1=admin,2=student,3=parent,4=educator');
			$table->string('email');
			$table->string('password');
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
			$table->date('dob')->nullable();
			$table->string('birthday_display_status');
			$table->integer('country_id');
			$table->integer('city_id');
			$table->integer('zip');
			$table->string('address');
			$table->integer('mobile_code');
			$table->integer('mobile_no');
			$table->string('status')->default('1');
			$table->string('remember_token')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->index(['country_id','city_id'], 'country_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nu_users');
	}

}
