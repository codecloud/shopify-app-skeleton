@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4">
                {{ $product->name }}
            </div>
        @endforeach
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4">
                {{ $product->amount }}
            </div>
        @endforeach
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4">
                @foreach ($product->features() as $feature)
                    <span class="feature-{{ $feature->status }}">{{ $feature->description }}</span>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <form method="post" action="">
                    {!! csrf_field() !!}
                    <input type="hidden" name="recurring_product_id" value="{{ $product->id }}" />
                    <button type="submit" class="btn primary">Select</button>
                </form>
            </div>
        @endforeach
    </div>

@endsection

@section('title')
    Subscription Plans
@endsection