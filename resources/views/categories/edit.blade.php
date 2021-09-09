@extends('layouts.app')

@section('title', 'Edit Categories')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <update-category category = "{{$category}}" list = "{{$all}}"></update-category>
    </div>
</div>
@endsection
