<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username', 50);
			$table->string('password', 100);
			$table->string('first_name', 50);
			$table->string('middle_name', 50);
			$table->string('last_name', 50);
			$table->string('email_address', 100);
			$table->tinyInteger('user_type')->default(0);
			$table->tinyInteger('status')->default(0);
			$table->string('remember_token', 100)->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
