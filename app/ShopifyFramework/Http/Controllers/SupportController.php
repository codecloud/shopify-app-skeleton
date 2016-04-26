<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ShopifyFramework\Entity\SupportTicket;
use App\ShopifyFramework\Http\Request\AddNewSupportMessage;
use App\ShopifyFramework\Http\Request\AddNewSupportTicket;
use App\ShopifyFramework\Process\CreateSupportTicket;
use App\ShopifyFramework\Process\UpdateSupportTicket;

class SupportController extends Controller
{
    public function getIndex()
    {
        return redirect('/support/open');
    }

    public function getOpenTickets()
    {
        return view('framework.support.open-tickets', [
            'tickets' => SupportTicket::findOpenForUser($this->user())
        ]);
    }

    public function getClosedTickets()
    {
        return view('framework.support.closed-tickets', [
            'tickets' => SupportTicket::findClosedForUser($this->user())
        ]);
    }

    public function getViewTicket($ticketId)
    {
        $ticket = SupportTicket::get($ticketId);

        $this->checkUserOwns($ticket);

        return view('framework.support.view-ticket', [
            'ticket' => $ticket
        ]);
    }

    public function getNewTicket()
    {
        return view('framework.support.new-ticket');
    }

    public function postNewTicket(AddNewSupportTicket $request)
    {
        $process = \App::make(CreateSupportTicket::class);
        $ticket = $process->create($this->user(), $request->get('subject'), $request->get('message'));

        $this->flashOK('Your support ticket was opened. ID ' . $ticket->id);

        return redirect('/support/view-ticket/' . $ticket->id);
    }

    public function postNewMessage(AddNewSupportMessage $request)
    {
        $ticket = SupportTicket::get($request->get('support_ticket_id'));

        /** @var UpdateSupportTicket $process */
        $process = \App::make(UpdateSupportTicket::class);
        $process->create($ticket, $request->get('message'), $request->get('author'));

        $this->flashOk('Your message was added to support ticket ID ' . $ticket->id);

        return redirect()->back();
    }
}