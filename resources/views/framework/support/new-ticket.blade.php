@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="section-summary">
            <h1>Support</h1>
            <p>Raise a new support ticket. We'll get back to you within 24 hours.</p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell">
                    <div class="section-options">
                        <ul class="section-tabs">
                            <li><a href="/support/open-tickets">Open Tickets</a></li>
                            <li><a href="/support/closed-tickets">Closed Tickets</a></li>
                            <li class="active"><a href="/support/new-ticket">New Ticket</a></li>
                        </ul>
                    </div>

                    <div  class="first-content-in-section">
                        <p>Tell us about the problem you're facing using the form below. We'll get back to you within 24 hours of your ticket being submitted.</p>
                        <p>If you'd prefer to communicate via email, you can reach us at <a href="mailto:support@imagineapps.co.uk">support@imagineapps.co.uk</a></p>
                    </div>

                    <form name="support.ticket" action="" method="post" class="first-content-in-section">
                        {!! csrf_field() !!}

                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" required placeholder="A short summary of your problem" maxlength="100" />

                        <label for="message">Message</label>
                        <textarea id="message" name="message" required placeholder="A detailed description of your problem. Please provide as much information as possible."></textarea>

                        <button type="submit" class="btn primary">Submit Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    New Support Ticket
@endsection