<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('dress_size')->nullable();
            $table->string('bust_size')->nullable();
            $table->string('eyes')->nullable();
            $table->string('hair')->nullable();
            $table->string('nationality')->nullable();
            $table->json('services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->dropColumn([
                'age',
                'height',
                'dress_size',
                'bust_size',
                'eyes',
                'hair',
                'nationality',
                'services'
            ]);
        });
    }
};
