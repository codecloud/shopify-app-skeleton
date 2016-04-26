@extends('framework.emails.standard')

@section('content')
    <h2>{{ $ticket->subject }}</h2>

    <p>{!! nl2br($message->message) !!}</p>

    <p><a href="{{ url('support/view-ticket', $ticket->id) }}">>Respond to this ticket</a></p>

    <p>Ticket was created at @timeFormat($message->created_at) on @dateFormat($message->created_at)</p>
@endsection