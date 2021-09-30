@extends('layouts.app')

@section('title', 'Edit Brand')

@section('links')
    <a class="btn btn-sm btn-outline-secondary ml-2" href="{{ route('brand.all') }}">
        <i class="bi bi-arrow-left-circle"></i>&nbsp;
        Return
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <update-brand brand="{{ $brand }}"></update-brand>
        </div>
    </div>
@endsection
