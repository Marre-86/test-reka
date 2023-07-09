<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_task', function (Blueprint $table) {
            $table->primary(['tag_id','task_id']);
            $table->integer('task_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_task');
    }
};
