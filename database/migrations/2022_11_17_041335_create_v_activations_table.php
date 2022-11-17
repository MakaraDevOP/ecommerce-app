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
            CREATE VIEW vactivation
            AS
            SELECT
		        activations.id,
	        	customers.company_name,
	        	activations.details,
	        	activations.is_active,
        		Count(*) AS 'number_product',
		        customers.phone,
	        	customers.email
	        FROM
		        activations
		    JOIN 
                customers ON activations.customer_id = customers.id
		    LEFT JOIN 
                activation_lines ON activations.id = activation_lines.activation_id 
            GROUP BY activations.id 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_activations');
    }
};