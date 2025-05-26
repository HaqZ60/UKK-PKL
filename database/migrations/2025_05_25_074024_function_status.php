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
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         DB::unprepared("


            CREATE FUNCTION ketStatusPKL(status BOOLEAN) RETURNS VARCHAR(50)
            DETERMINISTIC
            BEGIN
                IF status = 0 THEN
                    RETURN 'Belum diterima PKL';
                ELSEIF status = 1 THEN
                    RETURN 'Sudah diterima PKL';
                ELSE
                    RETURN 'Status tidak diketahui';
                END IF;
            END;


        ");

    }
};
