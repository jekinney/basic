<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->index();
            $table->integer('user_id');
            $table->integer('assigned_id')->nullable();
            $table->string('subject', 120);
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->boolean('requires_reply')->default(false);
            $table->boolean('send_notification')->default(false);
            $table->boolean('notification_sent')->default(false);
            $table->timestamp('user_deleted_at')->nullable();
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
        Schema::dropIfExists('supports');
    }
}
