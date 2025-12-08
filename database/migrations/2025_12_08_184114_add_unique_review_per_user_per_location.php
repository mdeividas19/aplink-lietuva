<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
        DELETE r1
        FROM reviews r1
        JOIN reviews r2
          ON r1.location_id = r2.location_id
         AND r1.user_id    = r2.user_id
         AND r1.id         > r2.id
    ");

        Schema::table('reviews', function (Blueprint $table) {
            $table->unique(['location_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique(['reviews_location_id_user_id_unique']);
            
        });
    }
};
