<?php

namespace App\Jobs;

use App\Model\User;
use Illuminate\Bus\Queueable;
use App\Notifications\ExportsGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var user
     */
    protected $user;
    protected $excelName;

    /**
     * Create a new job instance.
     * @param $user
     * @param $excelName
     * @return void
     */
    public function __construct($user,$excelName)
    {
        $this->user = $user;
        $this->excelName = $excelName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->user->notify(new ExportsGenerated($this->excelName));
    }
}