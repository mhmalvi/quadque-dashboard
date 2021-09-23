@extends('layouts.app')

@section('title', 'Update Product')

@section('links')
    <a class="btn btn-sm btn-outline-secondary ml-2" href="{{ route('product.all') }}">
        <i class="bi bi-arrow-left-circle"></i>&nbsp;
        Return
    </a>
@endsection

@section('content')
    <div class="container">
        <product-component product="{{ $product }}"></product-component>
    </div>
@endsection
