<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use Mail;
use App\Models\User;
use App\Mail\NotifyEmail;
use Illuminate\Console\Command;

class NotifyUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify user every minute';

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
     * @return mixed
     */
    public function handle()
    {
        // $emails = User::pluck('email')->take(2)->all();
        $emails = User::chunk(10, function ($data) {

            dispatch(new SendMailJob($data));
        });
        return 'my message';
        // $data = ['sub' => 'notify', 'prog' => 'php'];
        
        // foreach ($emails as $email) {

        //     Mail::to($email)->send(new NotifyEmail($data));
        // }

    }
}
