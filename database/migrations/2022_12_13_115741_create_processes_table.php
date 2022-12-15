<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->integer('lawyer_id')->nullable();
            $table->string('file_name')->nullable();
            $table->text('file_url')->nullable();
            $table->string('file_size')->nullable();
            $table->string('court_type')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('assign_to_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
