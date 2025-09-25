<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($booking, $gig)
    {
        $this->booking = $booking;
        $this->gig = $gig;
    }

    public function build()
    {
        return $this->subject('Booking Notification: ' . $this->gig->title)
            ->view('auth.booking_notification')
            ->with([
                'booking' => $this->booking,
                'gig' => $this->gig,
            ]);
    }
}
