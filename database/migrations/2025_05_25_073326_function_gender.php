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
        DB::unprepared("DROP FUNCTION IF EXISTS ketGender");
        
        DB::unprepared("
            CREATE FUNCTION ketGender(jk CHAR(1)) RETURNS VARCHAR(20)
            DETERMINISTIC
            READS SQL DATA
            BEGIN
                IF jk = 'L' THEN
                    RETURN 'Laki-laki';
                ELSEIF jk = 'P' THEN
                    RETURN 'Perempuan';
                ELSE
                    RETURN 'Tidak Diketahui';
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS ketGender");
    }
};
