<?php

namespace App\Jobs;

use App\Mail\MailingListSub;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailingSubJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $title;

    private string $content;

    private string $from;

    private array $mails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mails, $title, $content, $from)
    {
        $this->title = $title;
        $this->content = $content;
        $this->from = $from;
        $this->mails = $mails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->mails as $mail => $key) {
            Mail::to($mail)->cc($this->from)->send(new MailingListSub($this->title, $this->content, $key));
        }
    }
}
