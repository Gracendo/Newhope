<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminRejectionNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $admin;
    public $reason;

    public function __construct(Admin $admin, $reason = null)
    {
        $this->admin = $admin;
        $this->reason = $reason ?? 'No reason provided';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Admin Account Application Status',
        );
    }

    public function content(): Content
    {
        // HTML version
        $html = sprintf('
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { color: #d9534f; font-size: 24px; margin-bottom: 20px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">Account Not Approved</div>
                <p>Hello %s,</p>
                <p>We regret to inform you that your admin account request has been <strong>rejected</strong>.</p>
                %s
                <p>If you believe this is a mistake, please contact our support team.</p>
                <p>Best regards,<br>%s</p>
            </div>
        </body>
        </html>',
            $this->admin->first_name,
            $this->reason ? '<p><strong>Reason:</strong> '.htmlspecialchars($this->reason).'</p>' : '',
            config('app.name'));

        // Plain text version
        $text = sprintf("Account Not Approved\n\n"
                      ."Hello %s,\n\n"
                      ."We regret to inform you that your admin account request has been rejected.\n\n"
                      .'%s'
                      ."If you believe this is a mistake, please contact our support team.\n\n"
                      ."Best regards,\n%s",
            $this->admin->first_name,
            $this->reason ? 'Reason: '.$this->reason."\n\n" : '',
            config('app.name'));

        return new Content(
            htmlString: $html,  // Correct parameter name for HTML content
            text: $text         // Correct parameter name for plain text
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
