<?php

namespace App\Jobs;

use App\Models\Notify\Email;
use App\Models\User;
use App\Notifications\AdminEmailSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email;

    /**
     * Create a new job instance.
     *
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::query()->whereNotNull('email')->get();

        foreach ($users as $user){

            $user->notify(new AdminEmailSend($this->email->subject,$this->email->body,$this->email->files));
        }
    }
}
