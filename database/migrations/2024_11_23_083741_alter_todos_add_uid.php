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
        Schema::table('todos', function (Blueprint $t) {
            $t->bigInteger('uid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Leave empty. Later drop the table if necessary.
    }
};
