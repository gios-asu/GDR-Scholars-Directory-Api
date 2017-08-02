<?php

namespace GdrScholars\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcknowledgeApplication extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * The application details being submitted for a fellowship opportunity
     *
     * @var Application
     */
    public $application;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.acknowledge-application')
            ->subject('Your USAID Fellowship Application has been submitted');
    }
}
