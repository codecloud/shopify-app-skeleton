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
                            <li><a href="/support/open-tickets">Open Tickets</a></li>
                            <li class="active"><a href="/support/closed-tickets">Closed Tickets</a></li>
                            <li><a href="/support/new-ticket">New Ticket</a></li>
                        </ul>
                    </div>

                    @if ($tickets)
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
                                    <td>@dateFormat($ticket->updated_at)</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="box notice">
                            <i class="ico-notice"></i>
                            You have no closed support tickets.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Closed Support Tickets
@endsection