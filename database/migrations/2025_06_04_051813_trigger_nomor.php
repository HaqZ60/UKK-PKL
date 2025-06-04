<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop triggers if they exist
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_siswas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_update_siswas');
        
        // Trigger BEFORE INSERT
        DB::unprepared('
            CREATE TRIGGER before_insert_siswas
            BEFORE INSERT ON siswa FOR EACH ROW
            BEGIN
                IF LEFT(NEW.kontak, 2) = "08" THEN
                    SET NEW.kontak = CONCAT("+62", SUBSTRING(NEW.kontak, 2));
                END IF;
            END
        ');

        // Trigger BEFORE UPDATE
        DB::unprepared('
            CREATE TRIGGER before_update_siswas
            BEFORE UPDATE ON siswa FOR EACH ROW
            BEGIN
                IF LEFT(NEW.kontak, 2) = "08" THEN
                    SET NEW.kontak = CONCAT("+62", SUBSTRING(NEW.kontak, 2));
                END IF;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_siswas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_update_siswas');
    }
};
