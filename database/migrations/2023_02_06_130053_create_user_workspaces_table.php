<?php

use App\Enums\UserWorkspaceAccessTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workspaces', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('workspace_id');
            $table->string('access_type')->default(UserWorkspaceAccessTypeEnum::ADMIN->value);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->cascadeOnDelete();
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
        Schema::dropIfExists('user_workspaces');
    }
};