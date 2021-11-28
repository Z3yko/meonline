<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('img')->nullable();
            $table->string('d_name')->nullable();
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('dark_mode')->nullable();
            $table->string('bg_img')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_info');
    }
}
