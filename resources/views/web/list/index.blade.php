@extends('layouts.app')

@section('content')

    <div class="app">

        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
        <list-main-card :listimport="{{$list}}"></list-main-card>

    </div>

@endsection
