<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\users;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeleteUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date_now = Carbon::now();
        $day = date('d/m/Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_now)))) . PHP_EOL;
        $user = DB::table('users')->whereNotNull('deleted_at')->get();
        
        foreach($user as $key => $value){
            $date = date('d/m/Y',strtotime('+15 days',strtotime(str_replace('/', '-', $value->deleted_at)))) . PHP_EOL;
            if($day == $date){
                DB::table('users')->whereNotNull('deleted_at')->delete();
            }
        }
    }
}
