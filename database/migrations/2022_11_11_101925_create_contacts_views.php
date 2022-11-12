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
            CREATE VIEW vcontacts 
            AS
            SELECT
                contacts.id,
                contacts.title,
                contacts.full_name,
                contacts.phone,
                contacts.email,
                customers.company_name,
                customers.detail_address
            FROM
                contacts
            LEFT JOIN customers ON contacts.company_id = customers.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};