<?php

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('priority')->default(TaskPriorityEnum::MEDIUM->value);
            $table->date('due_date')->nullable();
            $table->string('type')->default(TaskTypeEnum::TASK->value);
            //$table->integer('column_id')->nullable();
            //$table->integer('reporter_id');
            //$table->integer('assignee_id');
            $table->foreignId('column_id')->references('id')->on('columns')->cascadeOnDelete();
            $table->foreignId('reporter_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('assignee_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('tasks');
    }
};
