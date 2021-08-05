<?php

namespace App\Mail;

use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $log;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Log $log) {
        $this->user = $user;
        $this->log = $log;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('emails.logs_notification');
    }
}
