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
        /*
        * $table->integer('priority')->nullable();
        * Making priority nullable will create a new tasks category while
        * filtering. Since filtering tasks that don't have any priority
        * didn't make much sense to be in their own category neither could
        * them be included with other categories. So I decided if not explicitly
        * set tasks will have low priority.
        */
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->text('description');
            $table->boolean('status')->default(false);
            $table->boolean('priority')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
