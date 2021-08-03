<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                // I make the assumption that the customers are \Models\User
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('CASCADE');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('phone_number', 15);
                $table->string('linkedin_url')->nullable();
                $table->string('country')->nullable();
                $table->string('city')->nullable();
                $table->timestamps();
            });
        } catch (\Exception $e) {
            (new ConsoleOutput)->writeln(
                '<error>[ContactManager API] Migration failed: ' . $e->getMessage() . '</error>'
            );
            Log::emergency('[ContactManager API] Migration failed: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
