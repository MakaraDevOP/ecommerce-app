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
            CREATE OR REPLACE VIEW vcontacts 
            AS
            SELECT
                contacts.id,
                contacts.title,
                contacts.full_name,
                contacts.phone AS 'contact_phone',
                contacts.email AS 'contact_email',
                contacts.description,
                contacts.is_active,
                customers.company_name,
                customers.detail_address,
                customers.phone AS 'company_phone',
                customers.email AS 'company_email'
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
        Schema::dropIfExists('vcontacts');

    }
};