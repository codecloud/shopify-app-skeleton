@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="section-summary">
            <h1>Support</h1>
            <p>View your support ticket and reply with an update.</p>

            <p>@include('framework.common.widgets.ticket-status', ['ticket' => $ticket])</p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell">
                    <div class="section-options">
                        <ul class="section-tabs">
                            <li><a href="/support/open-tickets">Open Tickets</a></li>
                            <li><a href="/support/closed-tickets">Closed Tickets</a></li>
                            <li><a href="/support/new-ticket">New Ticket</a></li>
                            <li class="active"><a href="#">View Ticket</a></li>
                        </ul>
                    </div>

                    <div class="first-content-in-section support-thread">
                        <h2>{{ $ticket->subject }}</h2>

                        @foreach ($ticket->messages as $message)
                            <div class="message">
                                <div class="metadata">
                                    <span class="left">Posted by {{ $message->author }}</span>
                                    <span class="right">@dateFormat($message->created_at) - @timeFormat($message->created_at)</span>
                                </div>
                                <div class="content">
                                    {!! nl2br($message->message) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($ticket->status != 'Closed')
                    <form name="support.message" action="/support/new-message" method="post" class="first-content-in-section">
                        {!! csrf_field() !!}
                        <input name="support_ticket_id" type="hidden" value="{{ $ticket->id }}" />

                        <label for="message">Message</label>
                        <textarea id="message" name="message" required placeholder="Update us on your issue."></textarea>

                        <button type="submit" class="btn primary">Submit Message</button>
                    </form>
                    @else
                        <div class="box notice">
                            <i class="ico-notice"></i>
                            This ticket has been closed, so no further messages can be posted.
                            To discuss another issue, please <a href="/support/new-ticket">open a new ticket</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    {{ $ticket->subject }}
@endsection

@section('styles')
    <link href="/css/support.css" type="text/css" rel="stylesheet" />
@endsection