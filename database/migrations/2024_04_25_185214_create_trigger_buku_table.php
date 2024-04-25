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
        DB::unprepared('
        CREATE TRIGGER insert_buku_trigger AFTER INSERT ON buku
        FOR EACH ROW
        BEGIN
            INSERT INTO logs_buku (id_buku, action, tanggal)
            VALUES (NEW.id, "insert", CURRENT_TIMESTAMP());
        END
    ');

    DB::unprepared('
        CREATE TRIGGER update_buku_trigger AFTER UPDATE ON buku
        FOR EACH ROW
        BEGIN
            INSERT INTO logs_buku (id_buku, action, tanggal)
            VALUES (NEW.id, "update", CURRENT_TIMESTAMP());
        END
    ');

    DB::unprepared('
        CREATE TRIGGER delete_buku_trigger AFTER DELETE ON buku
        FOR EACH ROW
        BEGIN
            INSERT INTO logs_buku (id_buku, action, tanggal)
            VALUES (OLD.id, "delete", CURRENT_TIMESTAMP());
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_buku');
    }
};
