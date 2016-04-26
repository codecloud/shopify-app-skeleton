<?php
namespace App\ShopifyFramework\Process;

use App\ShopifyFramework\Entity\SupportMessage;
use App\ShopifyFramework\Entity\SupportTicket;
use App\ShopifyFramework\Entity\User;
use Illuminate\Mail\Mailer;

class CreateSupportTicket
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param User $user
     * @param string $subject
     * @param string $message
     * @return SupportTicket
     */
    public function create(User $user, $subject, $message)
    {
        $ticket  = $this->createTicket($subject, $user);
        $message = $this->createMessage($ticket, $message);
        $this->notifySupport($ticket, $message);
        return $ticket;
    }

    /**
     * @param string $subject
     * @param User $user
     * @return SupportTicket
     */
    private function createTicket($subject, User $user)
    {
        $ticket = new SupportTicket();
        $ticket->subject = $subject;
        $ticket->user_id = $user->id;
        $user->tickets()->save($ticket);
        return $ticket;
    }

    /**
     * @param SupportTicket $ticket
     * @param string $message
     * @return mixed
     */
    private function createMessage(SupportTicket $ticket, $message)
    {
        $messageProcess = \App::make(UpdateSupportTicket::class);
        $messageProcess->disableEmailNotifications();
        $message = $messageProcess->create($ticket, $message, SupportTicket::AUTHOR_CUSTOMER);
        $ticket->messages()->save($message);
        return $message;
    }

    /**
     * @param SupportTicket  $ticket
     * @param SupportMessage $message
     */
    private function notifySupport(SupportTicket $ticket, SupportMessage $message)
    {
        $this->mailer->send('framework.emails.new-ticket', compact('ticket', 'message'), function($mail) use ($ticket) {
            $mail->subject = 'New support ticket: ' . $ticket->id;
            $mail->to('support@imagineapps.co.uk');
            $mail->from('shopify-support@imagineapps.co.uk');
            $mail->send();
        });
    }
}