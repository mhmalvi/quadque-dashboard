@extends('layouts.app')

@section('title', 'Edit Categories')

@section('links')
    <a class="btn btn-sm btn-outline-secondary ml-2" href="{{ route('category.all') }}">
        <i class="bi bi-arrow-left-circle"></i>&nbsp;
        Return
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <update-category category = "{{$category}}" list = "{{$all}}"></update-category>
        </div>
    </div>
@endsection
