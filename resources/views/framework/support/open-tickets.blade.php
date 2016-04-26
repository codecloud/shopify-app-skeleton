@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="section-summary">
            <h1>Support</h1>
            <p>Talk to us about any issues that you have.</p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell">
                    <div class="section-options">
                        <ul class="section-tabs">
                            <li class="active"><a href="/support/open-tickets">Open Tickets</a></li>
                            <li class=""><a href="/support/closed-tickets">Closed Tickets</a></li>
                            <li class=""><a href="/support/new-ticket">New Ticket</a></li>
                        </ul>
                    </div>

                    @if ($tickets)
                    <div class="box notice">
                        <i class="ico-notice"></i>
                        Would you like to <a href="/support/new-ticket">create a new ticket</a>?
                    </div>

                    <table class="table-section">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>@dateFormat($ticket->updated_at) - @timeFormat($ticket->updated_at)</td>
                                <td><a class="btn default" href="/support/view-ticket/{{ $ticket->id }}">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="box notice">
                        <i class="ico-notice"></i>
                        You have no open support tickets. Would you like to <a href="/support/new-ticket">create a new one</a>?
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Open Support Tickets
@endsection