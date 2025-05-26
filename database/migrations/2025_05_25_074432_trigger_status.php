<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("


            CREATE TRIGGER update_status_pkl
            AFTER INSERT ON pkl
            FOR EACH ROW
            BEGIN
                UPDATE siswa
                SET status_pkl = true
                WHERE id = NEW.siswa_id;
            END;


        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
