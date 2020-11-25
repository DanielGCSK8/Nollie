<?php

namespace App\Jobs;

use App\Model\User;
use App\Notifications\ReportsGenerated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyCompletedReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     /**
     * @var user
     */
    protected $user;

    /**
     * Create a new job instance.
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->user->notify(new ReportsGenerated());
        
    }
}
