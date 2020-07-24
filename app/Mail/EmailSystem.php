<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSystem extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emailtemplate.register')
                ->from($this->data['sendermail'], $this->data['sendername'])
                // ->cc($this->data['ccmail'], 'chaiwat')
                // ->bcc($address, $name)
                // ->replyTo($address, $name)
                ->subject($this->data['title'])
                ->with([
        'message' => $this->data['message']
        ]);;
    }
}
