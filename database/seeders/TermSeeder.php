<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Term;
class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Term::create([
            'name' => 'Monthly', 
            'term' => '1',
            'description' => 'for monthly',
        ]);
        Term::create([
            'name' => 'Quarterly', 
            'term' => '3',
            'description' => 'for quarterly',
        ]);
        Term::create([
            'name' => 'Semesterly', 
            'term' => '6',
            'description' => 'for semesterly',
        ]);
        Term::create([
            'name' => 'Yearly', 
            'term' => '12',
            'description' => 'for yearly',
        ]);
        Term::create([
            'name' => 'Custom', 
            'term' => '1',
            'description' => 'for custom',
        ]);
    }
}