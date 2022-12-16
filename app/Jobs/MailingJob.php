<?php

namespace App\Jobs;

use App\Mail\MailingList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $mails;

    private string $title;

    private string $content;

    private string $from;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mails, $title, $content, $from)
    {
        $this->mails = $mails;
        $this->from = $from;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->mails as $mail) {
            Mail::to($mail)->cc($this->from)->send(new MailingList($this->title, $this->content));
        }
    }
}
