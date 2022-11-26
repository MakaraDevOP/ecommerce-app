<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          \DB::statement("
            CREATE OR REPLACE VIEW vnote
            AS
            SELECT
            notes.id AS 'note_id',
            users.id AS 'user_id',
            activations.id AS 'activation_id',
            activation_lines.id AS 'activation_line_id',
            users.name as 'user_name',
            notes.body,
            notes.title,
            notes.created_at AS 'note_create_at',
            notes.updated_at AS 'note_update_at'
            
        FROM
            notes
            JOIN activation_lines ON activation_lines.id = notes.activation_line_id
            JOIN activations ON activations.id = notes.activation_id
            JOIN users ON users.id = notes.user_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vnotes');
    }
};