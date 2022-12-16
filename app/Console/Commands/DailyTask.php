<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActivationLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DailyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

    /**
     * Execute the console command. 
     *
     * @return int
     */
    public function handle()
    {
        $nowTimeDate = Carbon::now();
        $date = Carbon::parse($nowTimeDate)->format('d-mm-Y');
    //    $data =   ActivationLine::where('expired_date' < NOW())->update(['status'=>3]);
       $data = DB::table('activation_lines')->whereDate('expired_date', '<', $date)
            ->update(['status'=>3]);   
        Log::info($data);
        Log::info($date);

    }
}