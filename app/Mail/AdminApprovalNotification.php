<?php

namespace App\Mail;

use App\Models\Admin;  // Import Admin model
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminApprovalNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $admin;  // Public property to store admin data

    /**
     * Create a new message instance.
     * Receives the Admin model and stores it.
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the message envelope (email subject).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Admin Account Has Been Approved',  // Email subject
        );
    }

    /**
     * Get the message content (email body)
     * Uses our 'emails.admin_approved' Blade template.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_approved',  // Links to our Blade template
            with: ['admin' => $this->admin]  // Passes admin data to the view
        );
    }

    /**
     * No attachments needed.
     */
    public function attachments(): array
    {
        return [];
    }
}
