<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActivationLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Mail;
use App\Mail\SendMailable;


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
        $date = Carbon::parse($nowTimeDate)->format('d-m-Y');
        $activation =  DB::table('activation_lines')->where('expired_date', '<=', $date)->get();

         if(!empty($activation)){
            foreach ($activation as $item) {
                $data = array('data' => $item);
                if($item->is_notify_email != 1 && $item->status == 1) {
                    Mail::to('makara@dev.com.kh')->send(new SendMailable());
                    DB::table('activation_lines')->where('id', $item->activation_id)->update(['status' => 3, 'is_notify_email' => 1]);
                } 
                sleep(5);
            }
        }
    }
}