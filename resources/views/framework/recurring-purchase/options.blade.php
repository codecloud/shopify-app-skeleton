@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="section-summary">
            <h1>Your Plan</h1>
            <p>Select a plan to subscribe to.<br />You'll be billed through Shopify every 30 days.</p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell product-description">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-4 name">
                                {{ $product->display_name }}
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-4 price">
                                &dollar;{{ number_format($product->amount, 2) }} / month
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-4">
                                @foreach ($product->features() as $feature)
                                    <span class="feature {{ $feature->status }}">{{ $feature->description }}</span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-4 cta">
                                <form method="post" action="/recurring-purchase/make">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="recurring_product_id" value="{{ $product->id }}" />
                                    <button type="submit" class="btn primary">Choose {{ $product->display_name }} Plan</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Subscription Plans
@endsection

@section('styles')
    <link href="/css/purchase.css" rel="stylesheet" type="text/css" />
@endsection