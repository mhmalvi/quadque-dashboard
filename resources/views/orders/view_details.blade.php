@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="container-fluid">
        <order-details order="{{ $order }}"></order-details>
    </div>
@endsection
