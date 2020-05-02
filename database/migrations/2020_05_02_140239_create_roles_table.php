<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('label')->nullable();
			$table->timestamps();
		});

		Schema::create('abilities', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('label')->nullable();
			$table->timestamps();
		});

		Schema::create('ability_role', function (Blueprint $table) {
			$table->primary(['role_id', 'ability_id']);

			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('ability_id');
			$table->timestamps();
		});

		Schema::table('ability_role', function (Blueprint $table) {
			$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade');

			$table->foreign('ability_id')
					->references('id')
					->on('abilities')
					->onDelete('cascade');
		});

		Schema::create('role_user', function (Blueprint $table) {
			$table->primary(['role_id', 'user_id']);

			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('user_id');
			$table->timestamps();
		});

		Schema::table('role_user', function (Blueprint $table) {
			$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade');

			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');
		});
	}
}
