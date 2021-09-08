@extends('layouts.app')

@section('title', 'Edit Categories')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <edit-category category = "{{$category}}" list = "{{$all}}"></edit-category>
    </div>
</div>
@endsection
