@if ($ticket->status == 'Open')
    <span class="tag green" title="The ticket has been opened. Our support team will be in touch soon.">Status: {{ $ticket->status }}</span>
@elseif ($ticket->status == 'Awaiting customer reply')
    <span class="tag yellow" title="We're waiting a response from you. Get back in touch when you can.">Status: {{ $ticket->status }}</span>
@elseif ($ticket->status == 'Awaiting reply from Imagine Apps')
    <span class="tag orange" title="We received your latest message. Our support team will be in touch soon.">Status: Awaiting reply from support</span>
@elseif ($ticket->status == 'Closed')
    <span class="tag gray" title="This ticket has been closed. If you would like to raise another issue, please open another support ticket.">Status: {{ $ticket->status }}</span>
@endif