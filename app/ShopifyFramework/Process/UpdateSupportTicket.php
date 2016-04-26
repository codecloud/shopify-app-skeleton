<?php
namespace App\ShopifyFramework\Process;

use App\ShopifyFramework\Entity\SupportMessage;
use App\ShopifyFramework\Entity\SupportTicket;
use Illuminate\Mail\Mailer;

class UpdateSupportTicket
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var bool
     */
    private $emailNotificationsEnabled = true;

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param SupportTicket  $ticket
     * @param string $messageStr
     * @param string  $author
     * @return SupportMessage
     */
    public function create(SupportTicket $ticket, $messageStr, $author)
    {
        $message = new SupportMessage();
        $message->message = $messageStr;
        $message->author = $author;
        $ticket->messages()->save($message);
        $ticket->touch();

        if ($author == SupportTicket::AUTHOR_CUSTOMER) {
            $this->notifySupport($ticket, $message);
        } elseif ($author == SupportTicket::AUTHOR_IMAGINE_APPS) {
            $this->notifyCustomer($ticket, $message);
        }

        return $message;
    }

    public function disableEmailNotifications()
    {
        $this->emailNotificationsEnabled = false;
    }

    private function notifySupport(SupportTicket $ticket, SupportMessage $message)
    {
        if (! $this->emailNotificationsEnabled) {
            return;
        }

        $this->mailer->send('framework.emails.new-support-message', compact('ticket', 'message'), function($mail) use ($ticket) {
            $mail->subject = $ticket->subject;
            $mail->to('support@imagineapps.co.uk');
            $mail->from($ticket->user->email_address, $ticket->user->name);
            $mail->send();
        });
    }

    private function notifyCustomer(SupportTicket $ticket, SupportMessage $message)
    {
        if (! $this->emailNotificationsEnabled) {
            return;
        }

        $this->mailer->send('framework.emails.new-support-message', compact('ticket', 'message'), function($mail) use ($ticket) {
            $mail->subject = $ticket->subject;
            $mail->to($ticket->user->email_address, $ticket->user->name);
            $mail->from('support@imagineapps.co.uk', 'Imagine Apps Support');
            $mail->send();
        });
    }
}