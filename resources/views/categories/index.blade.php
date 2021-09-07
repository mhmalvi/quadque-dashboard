@extends('layouts.app')

@section('title', 'Product Categories')

@section('content')
    <category-component categories="{{$categories}}"></category-component>
@endsection
