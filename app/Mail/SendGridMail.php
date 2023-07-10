<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SendGrid\Mail\Mail as SendGridMailTemp;

class SendGridMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $templateId;
    protected $templateData;

    /**
     * Create a new message instance.
     *
     * @param string $templateId
     * @param array $templateData
     * @return void
     */
    public function __construct($templateId, $templateData = [])
    {
        $this->templateId = $templateId;
        $this->templateData = $templateData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = new SendGridMailTemp();
        $mail->setTemplateId($this->templateId);
        $mail->dynamicTemplateData = $this->templateData;

        return $this->with([
            'sendgrid' => $mail->json(),
            'contentType' => 'application/json',
        ]);
    }
}